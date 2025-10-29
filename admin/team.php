<?php
// admin/team.php - Team Management

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/auth.php';

$auth = new Auth();

// Redirect to login if not authenticated
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = $auth->getUser();
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $full_name = trim($_POST['full_name']);
                $position = trim($_POST['position']);
                $bio = trim($_POST['bio']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $display_order = (int)$_POST['display_order'];
                $is_active = isset($_POST['is_active']) ? 1 : 0;
                
                if (!empty($full_name) && !empty($position)) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO team (full_name, position, bio, email, phone, display_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt->execute([$full_name, $position, $bio, $email, $phone, $display_order, $is_active])) {
                            $message = "Team member added successfully!";
                        }
                    } catch (PDOException $e) {
                        $message = "Error adding team member: " . $e->getMessage();
                    }
                }
                break;
                
            case 'delete':
                $id = (int)$_POST['id'];
                try {
                    $stmt = $pdo->prepare("DELETE FROM team WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $message = "Team member deleted successfully!";
                    }
                } catch (PDOException $e) {
                    $message = "Error deleting team member: " . $e->getMessage();
                }
                break;
                
            case 'toggle_status':
                $id = (int)$_POST['id'];
                try {
                    $stmt = $pdo->prepare("UPDATE team SET is_active = NOT is_active WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $message = "Team member status updated!";
                    }
                } catch (PDOException $e) {
                    $message = "Error updating status: " . $e->getMessage();
                }
                break;
        }
    }
}

// Get all team members
try {
    $stmt = $pdo->query("SELECT * FROM team ORDER BY display_order ASC, full_name ASC");
    $team_members = $stmt->fetchAll();
} catch (PDOException $e) {
    $team_members = [];
    $message = "Error loading team members: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management - Ndawonga Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: #f5f5f5;
        }
        
        .admin-header {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .btn {
            background: #1a5276;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        
        .btn-success {
            background: #28a745;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .table th {
            background: #f8f9fa;
            font-weight: bold;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }
        
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .team-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #f9f9f9;
        }
        
        .team-card h4 {
            color: #1a5276;
            margin-bottom: 5px;
        }
        
        .team-card .position {
            color: #666;
            font-style: italic;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h2>Team Management</h2>
        <div>
            <a href="dashboard.php" class="btn">← Dashboard</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </header>
    
    <div class="admin-content">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <!-- Add New Team Member -->
        <div class="card">
            <h3>Add New Team Member</h3>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Position/Title</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Bio/Description</label>
                    <textarea name="bio" class="form-control" rows="3" placeholder="Brief description of the team member's role and experience"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="display_order" class="form-control" value="0" min="0">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" checked>
                        <label for="is_active">Active (visible on website)</label>
                    </div>
                </div>
                
                <button type="submit" class="btn">Add Team Member</button>
            </form>
        </div>
        
        <!-- Team Members List -->
        <div class="card">
            <h3>Team Members (<?php echo count($team_members); ?>)</h3>
            
            <?php if (empty($team_members)): ?>
                <p>No team members found. Add your first team member above.</p>
            <?php else: ?>
                <div class="team-grid">
                    <?php foreach ($team_members as $member): ?>
                    <div class="team-card">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div style="flex: 1;">
                                <h4><?php echo htmlspecialchars($member['full_name']); ?></h4>
                                <div class="position"><?php echo htmlspecialchars($member['position']); ?></div>
                                
                                <?php if ($member['bio']): ?>
                                    <p style="margin-bottom: 10px;"><?php echo htmlspecialchars($member['bio']); ?></p>
                                <?php endif; ?>
                                
                                <div style="font-size: 14px; color: #666;">
                                    <?php if ($member['email']): ?>
                                        <div>📧 <?php echo htmlspecialchars($member['email']); ?></div>
                                    <?php endif; ?>
                                    <?php if ($member['phone']): ?>
                                        <div>📞 <?php echo htmlspecialchars($member['phone']); ?></div>
                                    <?php endif; ?>
                                    <div>📋 Order: <?php echo $member['display_order']; ?></div>
                                </div>
                                
                                <div style="margin-top: 10px;">
                                    <span class="status-badge status-<?php echo $member['is_active'] ? 'active' : 'inactive'; ?>">
                                        <?php echo $member['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div style="display: flex; flex-direction: column; gap: 5px;">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="toggle_status">
                                    <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                                    <button type="submit" class="btn <?php echo $member['is_active'] ? 'btn-warning' : 'btn-success'; ?>" style="padding: 5px 10px; font-size: 12px;">
                                        <?php echo $member['is_active'] ? 'Deactivate' : 'Activate'; ?>
                                    </button>
                                </form>
                                
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this team member?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>