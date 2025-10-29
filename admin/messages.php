<?php
// admin/messages.php - Contact Messages Management

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
            case 'mark_read':
                $id = (int)$_POST['id'];
                try {
                    $stmt = $pdo->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $message = "Message marked as read!";
                    }
                } catch (PDOException $e) {
                    $message = "Error updating message: " . $e->getMessage();
                }
                break;
                
            case 'mark_unread':
                $id = (int)$_POST['id'];
                try {
                    $stmt = $pdo->prepare("UPDATE contact_messages SET is_read = 0 WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $message = "Message marked as unread!";
                    }
                } catch (PDOException $e) {
                    $message = "Error updating message: " . $e->getMessage();
                }
                break;
                
            case 'delete':
                $id = (int)$_POST['id'];
                try {
                    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
                    if ($stmt->execute([$id])) {
                        $message = "Message deleted successfully!";
                    }
                } catch (PDOException $e) {
                    $message = "Error deleting message: " . $e->getMessage();
                }
                break;
        }
    }
}

// Get filter
$filter = $_GET['filter'] ?? 'all';
$where_clause = '';
if ($filter === 'unread') {
    $where_clause = 'WHERE is_read = 0';
} elseif ($filter === 'read') {
    $where_clause = 'WHERE is_read = 1';
}

// Get all messages
try {
    $stmt = $pdo->query("SELECT * FROM contact_messages $where_clause ORDER BY created_at DESC");
    $messages = $stmt->fetchAll();
    
    // Get counts
    $stmt = $pdo->query("SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN is_read = 0 THEN 1 ELSE 0 END) as unread,
        SUM(CASE WHEN is_read = 1 THEN 1 ELSE 0 END) as read
        FROM contact_messages");
    $counts = $stmt->fetch();
} catch (PDOException $e) {
    $messages = [];
    $counts = ['total' => 0, 'unread' => 0, 'read' => 0];
    $message = "Error loading messages: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - Ndawonga Admin</title>
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
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .message-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: white;
        }
        
        .message-card.unread {
            border-left: 4px solid #1a5276;
            background: #f8f9ff;
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .message-info h4 {
            color: #1a5276;
            margin-bottom: 5px;
        }
        
        .message-meta {
            font-size: 14px;
            color: #666;
        }
        
        .message-content {
            margin: 15px 0;
            line-height: 1.6;
        }
        
        .message-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-unread {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-read {
            background: #d4edda;
            color: #155724;
        }
        
        .message-alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .filter-tab {
            padding: 10px 20px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }
        
        .filter-tab.active {
            background: #1a5276;
            color: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #1a5276;
        }
        
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h2>Contact Messages</h2>
        <div>
            <a href="dashboard.php" class="btn">← Dashboard</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </header>
    
    <div class="admin-content">
        <?php if ($message): ?>
            <div class="message-alert"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $counts['total']; ?></div>
                <div class="stat-label">Total Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $counts['unread']; ?></div>
                <div class="stat-label">Unread Messages</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $counts['read']; ?></div>
                <div class="stat-label">Read Messages</div>
            </div>
        </div>
        
        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <a href="?filter=all" class="filter-tab <?php echo $filter === 'all' ? 'active' : ''; ?>">
                All Messages (<?php echo $counts['total']; ?>)
            </a>
            <a href="?filter=unread" class="filter-tab <?php echo $filter === 'unread' ? 'active' : ''; ?>">
                Unread (<?php echo $counts['unread']; ?>)
            </a>
            <a href="?filter=read" class="filter-tab <?php echo $filter === 'read' ? 'active' : ''; ?>">
                Read (<?php echo $counts['read']; ?>)
            </a>
        </div>
        
        <!-- Messages List -->
        <div class="card">
            <?php if (empty($messages)): ?>
                <div style="text-align: center; padding: 40px;">
                    <h3>No messages found</h3>
                    <p>No contact messages match your current filter.</p>
                </div>
            <?php else: ?>
                <?php foreach ($messages as $msg): ?>
                <div class="message-card <?php echo $msg['is_read'] ? '' : 'unread'; ?>">
                    <div class="message-header">
                        <div class="message-info">
                            <h4><?php echo htmlspecialchars($msg['name']); ?></h4>
                            <div class="message-meta">
                                📧 <?php echo htmlspecialchars($msg['email']); ?>
                                <?php if ($msg['phone']): ?>
                                    | 📞 <?php echo htmlspecialchars($msg['phone']); ?>
                                <?php endif; ?>
                                | 📅 <?php echo date('M j, Y g:i A', strtotime($msg['created_at'])); ?>
                            </div>
                            <?php if ($msg['subject']): ?>
                                <div style="margin-top: 5px; font-weight: bold;">
                                    Subject: <?php echo htmlspecialchars($msg['subject']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <span class="status-badge status-<?php echo $msg['is_read'] ? 'read' : 'unread'; ?>">
                                <?php echo $msg['is_read'] ? 'Read' : 'Unread'; ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="message-content">
                        <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                    </div>
                    
                    <div class="message-actions">
                        <?php if ($msg['is_read']): ?>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="mark_unread">
                                <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                <button type="submit" class="btn btn-warning" style="padding: 5px 15px; font-size: 12px;">Mark Unread</button>
                            </form>
                        <?php else: ?>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="mark_read">
                                <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                <button type="submit" class="btn btn-success" style="padding: 5px 15px; font-size: 12px;">Mark Read</button>
                            </form>
                        <?php endif; ?>
                        
                        <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>?subject=Re: <?php echo htmlspecialchars($msg['subject'] ?: 'Your inquiry'); ?>" 
                           class="btn btn-secondary" style="padding: 5px 15px; font-size: 12px;">Reply</a>
                        
                        <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this message?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                            <button type="submit" class="btn btn-danger" style="padding: 5px 15px; font-size: 12px;">Delete</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>