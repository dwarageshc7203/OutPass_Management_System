<?php
session_start();
include 'db_connect.php';
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];
    $status = $action === 'approve' ? 'Approved' : 'Declined';
    $stmt = $conn->prepare("UPDATE outpass_requests SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
    $student_query = $conn->prepare("SELECT name, rollno, blockno FROM outpass_requests WHERE id=?");
    $student_query->bind_param("i", $id);
    $student_query->execute();
    $result = $student_query->get_result();
    $student = $result->fetch_assoc();
    $student_query->close();

    if ($student) {
        if ($status === 'Approved') {
            $_SESSION['approved'] = "Outpass approved for " . $student['name'] . " (Roll No: " . $student['rollno'] . ")";
        } else {
            $_SESSION['declined'] = " Outpass declined for " . $student['name'] . " (Roll No: " . $student['rollno'] . ")";
        }
    } else {
        $_SESSION['declined'] = "Student information not found.";
    }
    header("Location: warden_dashboard.php");
    exit();
}
$result = $conn->query("SELECT * FROM outpass_requests WHERE status='Pending'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Warden Dashboard - Outpass System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    header {
      background: #333333;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 1100px;
      margin: 30px auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .section {
      margin-bottom: 30px;
    }
    h2 {
      color: #333333;
    }
    .outpass-card {
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 15px;
      background-color: #fafafa;
      border-radius: 6px;
    }
    .message {
      margin-top: 20px;
      padding: 10px;
      background-color: #f0f8ff;
      border: 1px solid #ccc;
      color: green;
      text-align: center;
      font-weight: bold;
    }
    button {
      background-color: #333333;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      margin: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #222222;
    }
  </style>
</head>
<body>

<header>
  <h1>Warden Dashboard</h1>
</header>
<div class="container">
  <?php if (isset($_SESSION['approved'])): ?>
    <div class="message">
      <?php echo $_SESSION['approved']; unset($_SESSION['approved']); ?>
    </div>
  <?php elseif (isset($_SESSION['declined'])): ?>
    <div class="message" style="color: red;">
      <?php echo $_SESSION['declined']; unset($_SESSION['declined']); ?>
    </div>
  <?php endif; ?>
  <div class="section">
    <h2>Pending Outpass Requests</h2>
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="outpass-card">
          <p>
            <strong><?php echo htmlspecialchars($row['name']); ?> - <?php echo htmlspecialchars($row['rollno']); ?></strong>
            is requesting from Block <?php echo htmlspecialchars($row['blockno']); ?>.
          </p>
          <p>
            <strong>Destination:</strong> <?php echo htmlspecialchars($row['destination']); ?><br>
            <strong>Reason:</strong> <?php echo htmlspecialchars($row['reason']); ?><br>
            <strong>From:</strong> <?php echo $row['from_date']; ?><br>
            <strong>To:</strong> <?php echo $row['to_date']; ?><br>
            <strong>Transport:</strong> <?php echo $row['transport_mode']; ?>
          </p>
          <a href="?action=approve&id=<?php echo $row['id']; ?>"><button>Approve</button></a>
          <a href="?action=decline&id=<?php echo $row['id']; ?>"><button>Decline</button></a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No pending outpass requests.</p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
