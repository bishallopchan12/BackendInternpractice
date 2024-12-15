<?php
header("Content-Type: application/json");
require 'db.php';

function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

// Handle GET Request: Get all blogs or a single blog by ID
if ($method === 'GET') {
    if (isset($_GET['id'])) {
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
        $stmt = $conn->query("SELECT * FROM blogs");
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        respond($blogs);
    }
}

// Handle POST Request: Create a new blog
if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['title'], $data['description'], $data['category'])) {
        $stmt = $conn->prepare("INSERT INTO blogs (title, description, category) VALUES (?, ?, ?)");
        $stmt->execute([$data['title'], $data['description'], $data['category']]);
        respond(['message' => 'Blog created successfully'], 201);
    } else {
        respond(['error' => 'Invalid input'], 400);
    }
}

// Handle PUT Request: Update an existing blog
if ($method === 'PUT') {
    if (!isset($_GET['id'])) {
        respond(['error' => 'ID is required for updating a blog'], 400);
    }

    $id = intval($_GET['id']);
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['title'], $data['description'], $data['category'])) {
        $stmt = $conn->prepare("UPDATE blogs SET title = ?, description = ?, category = ? WHERE id = ?");
        $stmt->execute([$data['title'], $data['description'], $data['category'], $id]);

        if ($stmt->rowCount() > 0) {
            respond(['message' => 'Blog updated successfully']);
        } else {
            respond(['message' => 'No changes made or blog not found'], 404);
        }
    } else {
        respond(['error' => 'Invalid input'], 400);
    }
}

// Handle DELETE Request: Delete a blog
if ($method === 'DELETE') {
    if (!isset($_GET['id'])) {
        respond(['error' => 'ID is required for deleting a blog'], 400);
    }

    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        respond(['message' => 'Blog deleted successfully']);
    } else {
        respond(['message' => 'Blog not found'], 404);
    }
}

// Default handler for unsupported methods
respond(['error' => 'Method not allowed'], 405);
?>
