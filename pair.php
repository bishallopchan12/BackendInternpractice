<?php
function findPair($nums, $target) {
    // Create an associative array to store numbers and their indices
    $seen = [];

    foreach ($nums as $num) {
        // Calculate the complement
        $complement = $target - $num;

        // Check if the complement exists in the seen array
        if (isset($seen[$complement])) {
            echo "Pair found (" . $complement . ", " . $num . ")\n";
            return;
        }

        // Store the current number in the seen array
        $seen[$num] = true;
    }

    echo "Pair not found.\n";
}

// Test case 1
$nums1 = [8, 7, 2, 5, 3, 1];
$target1 = 10;
echo "Input: nums = [" . implode(", ", $nums1) . "], target = $target1\n";
findPair($nums1, $target1);

// Test case 2
$nums2 = [5, 2, 6, 8, 1, 9];
$target2 = 12;
echo "Input: nums = [" . implode(", ", $nums2) . "], target = $target2\n";
findPair($nums2, $target2);
?>
