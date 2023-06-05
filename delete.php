<?php
include('config.php');

// Check the database connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define the SQL queries to be executed
$query1 = "DELETE from master";

// Execute the SQL queries and check for errors
if ($conn->query($query1) === TRUE) {
  echo "<script>alert('Data deleted successfully!'); window.location.href = 'dep_select.php';</script>";
} else {
  echo "Error deleting data: " . $conn->error;
}

// Close the database connection
$conn->close();
?>