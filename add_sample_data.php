<?php
// Add sample data for testing admin panels

require_once 'config.php';

try {
    // Add sample services if none exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM services");
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        $services_sql = "INSERT INTO `services` (`title`, `description`, `icon_class`, `display_order`, `is_active`) VALUES
            ('Civil Engineering', 'Road construction, earthworks, and infrastructure development', 'fa-road', 1, 1),
            ('Waste Management', 'Comprehensive waste management solutions', 'fa-trash-alt', 2, 1),
            ('Construction', 'Building and construction projects', 'fa-building', 3, 1),
            ('Maintenance', 'Ongoing maintenance and support', 'fa-tools', 4, 1),
            ('Project Management', 'End-to-end project management services', 'fa-project-diagram', 5, 1),
            ('Consulting', 'Expert consulting and advisory services', 'fa-lightbulb', 6, 1)";
        
        $pdo->exec($services_sql);
        echo "<p>✓ Sample services added</p>";
    }
    
    // Add sample projects if none exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM projects");
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        $projects_sql = "INSERT INTO `projects` (`title`, `description`, `location`, `budget`, `status`, `start_date`, `end_date`, `client_name`) VALUES
            ('RBA Protea Glen Sectional Development', 'Residential sectional development project comprising multiple housing units with complete infrastructure.', 'Protea Glen, Johannesburg', 'R 489,000', 'completed', '2023-01-15', '2023-06-30', 'RBA Development'),
            ('Rea Vaya BRT Phase 1 NMT', 'Implementation of Non-Motorized Transport infrastructure for Rea Vaya Bus Rapid Transit system.', 'Johannesburg CBD', 'R 1,200,000', 'completed', '2022-08-01', '2023-03-15', 'City of Johannesburg'),
            ('Winnie Mandela Clinic Refurbishment', 'Comprehensive refurbishment and upgrade of healthcare facility with modern infrastructure.', 'Johannesburg', 'R 1,300,000', 'completed', '2023-02-01', '2023-09-30', 'Gauteng Department of Health'),
            ('Soweto Road Infrastructure Upgrade', 'Major road infrastructure upgrade including storm water drainage and street lighting.', 'Soweto, Johannesburg', 'R 2,500,000', 'in_progress', '2024-01-01', '2024-12-31', 'City of Johannesburg'),
            ('Alexandra Township Water Supply', 'Installation of new water supply infrastructure and pipe network upgrade.', 'Alexandra, Johannesburg', 'R 1,800,000', 'planning', '2024-06-01', '2025-03-31', 'Johannesburg Water')";
        
        $pdo->exec($projects_sql);
        echo "<p>✓ Sample projects added</p>";
    }
    
    // Add sample team members if none exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM team");
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        $team_sql = "INSERT INTO `team` (`full_name`, `position`, `bio`, `email`, `phone`, `display_order`, `is_active`) VALUES
            ('David Ndawonga', 'Managing Director & Founder', 'Experienced civil engineer with over 15 years in the construction industry. Leads strategic planning and client relations.', 'david@ndawonga.co.za', '+27 79 486 8145', 1, 1),
            ('Sarah Mthembu', 'Project Manager', 'Specialist in project coordination and client relations with 8 years of experience in infrastructure development.', 'sarah@ndawonga.co.za', '+27 11 941 5913', 2, 1),
            ('John Sibeko', 'Site Engineer', 'Expert in construction supervision and quality control with strong background in civil engineering projects.', 'john@ndawonga.co.za', '+27 11 941 5913', 3, 1),
            ('Mary Khumalo', 'Financial Manager', 'Responsible for financial planning and budget management with CPA qualification and 10 years experience.', 'mary@ndawonga.co.za', '+27 11 941 5913', 4, 1),
            ('Peter Mokoena', 'Health & Safety Officer', 'Certified safety professional ensuring all projects comply with health and safety regulations.', 'peter@ndawonga.co.za', '+27 11 941 5913', 5, 1)";
        
        $pdo->exec($team_sql);
        echo "<p>✓ Sample team members added</p>";
    }
    
    echo "<hr>";
    echo "<h3>Sample Data Setup Complete!</h3>";
    echo "<p>Your admin panels now have sample data to work with.</p>";
    echo "<p><a href='admin/dashboard.php'>Go to Admin Dashboard</a></p>";
    
} catch (PDOException $e) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>