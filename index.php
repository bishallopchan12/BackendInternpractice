<?php
header("Content-Type: application/json");
require 'db.php';

// Helper function for responses
function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// Handle GET Request: Get all blogs or a blog by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Get blog by ID
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($blog) {
            respond($blog);
        } else {
            respond(['message' => 'Blog not found'], 404);
        }
    } else {
        // Get all blogs
        $stmt = $conn->query("SELECT * FROM blogs");
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        respond($blogs);
    }
}

// Handle POST Request: Create a new blog
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['title'], $data['description'], $data['category'])) {
        $stmt = $conn->prepare("INSERT INTO blogs (title, description, category) VALUES (?, ?, ?)");
        $stmt->execute([$data['title'], $data['description'], $data['category']]);
        respond(['message' => 'Blog created successfully'], 201);
    } else {
        respond(['error' => 'Invalid input'], 400);
    }
}

// Handle PUT Request: Update a blog
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert id to an integer
    $input = json_decode(file_get_contents('php://input'), true); // Parse JSON input

    if (isset($input['title'], $input['description'], $input['category'])) {
        $stmt = $conn->prepare("UPDATE blogs SET title = ?, description = ?, category = ? WHERE id = ?");
        $stmt->execute([
            $input['title'],
            $input['description'],
            $input['category'],
            $id
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Blog updated successfully']);
        } else {
            echo json_encode(['message' => 'No changes made or blog not found']);
        }
    } else {
        http_response_code(400); // Bad request
        echo json_encode(['message' => 'Invalid input']);
    }
} else {
    http_response_code(405); // Method not allowed
    echo json_encode(['error' => 'Invalid request method']);
}


// Handle DELETE Request: Delete a blog
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        respond(['message' => 'Blog deleted successfully']);
    } else {
        respond(['message' => 'Blog not found'], 404);
    }
}

// Default response for unsupported routes
respond(['error' => 'Invalid request method'], 405);
?>
