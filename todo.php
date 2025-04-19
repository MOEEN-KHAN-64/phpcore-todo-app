<?php
include "checkcookie.php"; // Ensure the user is logged in

// Fetch filtered todos based on the selected filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
include "read.php"; // Fetch all todos from the database

if ($filter === 'completed') {
    $todos = array_filter($todos, fn($todo) => $todo['status'] == '1');
} elseif ($filter === 'uncompleted') {
    $todos = array_filter($todos, fn($todo) => $todo['status'] == '0');
}

// Check if an update request is triggered
$editId = isset($_GET['edit']) ? $_GET['edit'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #212529;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .welcome {
            font-size: 16px;
        }

        .header .logout {
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .header .logout:hover {
            background-color: #c82333;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .icon-btn:hover {
            color: #0056b3;
        }

        .delete-btn {
            color: #dc3545;
        }

        .delete-btn:hover {
            color: #c82333;
        }

        .checkbox {
            transform: scale(1.2);
            cursor: pointer;
        }

        .filter-form {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-form select {
            width: auto;
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="welcome">Welcome, User ID: <?php echo htmlspecialchars($_COOKIE['user']); ?></div>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="container">
        <h1>Todo List</h1>

        <!-- Filter Dropdown -->
        <form class="filter-form" method="get" action="todo.php">
            <select name="filter" onchange="this.form.submit();">
                <option value="all" <?php echo $filter === 'all' ? 'selected' : ''; ?>>All Tasks</option>
                <option value="completed" <?php echo $filter === 'completed' ? 'selected' : ''; ?>>Completed Tasks</option>
                <option value="uncompleted" <?php echo $filter === 'uncompleted' ? 'selected' : ''; ?>>Uncompleted Tasks</option>
            </select>
        </form>

        <!-- Create Todo Form -->
        <form action="create.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Enter todo title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" placeholder="Enter todo description" required></textarea>

            <input type="submit" value="Add Todo">
        </form>

        <!-- Display Todos -->
        <table>
            <tr>
                <th>Temp ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($todos)): ?>
                <?php $tempId = 1; // Initialize temporary ID ?>
                <?php foreach ($todos as $todo): ?>
                    <tr>
                        <td><?php echo $tempId++; ?></td> <!-- Display Temporary ID -->
                        <?php if ($editId == $todo['id']): ?>
                            <!-- Inline Editing Form -->
                            <form action="update.php" method="post">
                                <td>
                                    <input type="text" name="title" value="<?php echo htmlspecialchars($todo['title']); ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="description" value="<?php echo htmlspecialchars($todo['description']); ?>" required>
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                                    <input type="submit" value="Save">
                                </td>
                            </form>
                        <?php else: ?>
                            <!-- Display Row -->
                            <td><?php echo htmlspecialchars($todo['title']); ?></td>
                            <td><?php echo htmlspecialchars($todo['description']); ?></td>
                            <td>
                                <form action="status.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                                    <input type="hidden" name="status" value="<?php echo $todo['status'] == '1' ? '0' : '1'; ?>">
                                    <input type="checkbox" class="checkbox" <?php echo $todo['status'] == '1' ? 'checked' : ''; ?> onchange="this.form.submit();">
                                </form>
                            </td>
                            <td>
                                <div class="actions">
                                    <!-- Edit Button -->
                                    <a href="?edit=<?php echo $todo['id']; ?>" class="icon-btn">✏️</a>

                                    <!-- Delete Button -->
                                    <form action="delete.php" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                                        <button type="submit" class="icon-btn delete-btn" onclick="return confirm('Are you sure you want to delete this todo?');">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No todos found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>