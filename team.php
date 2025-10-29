<?php
$pageTitle = "Our Team";
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/database.php';
include __DIR__ . '/includes/header.php';

$database = new Database();
$db = $database->getConnection();

$teamMembers = [];
if ($db) {
    try {
        $query = "SELECT * FROM team_members WHERE is_active = 1 ORDER BY display_order, name";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Team query error: ' . $e->getMessage());
    }
}
?>

<style>
/* Team Hero Logo */
.team-hero-logo {
    width: 120px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    transition: all 0.3s ease;
}

.team-hero-logo:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(0,0,0,0.3);
}
</style>

<section class="py-5" style="margin-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <img src="assets/images/logo.jpg" alt="Ndawonga Trading and Projects Logo" class="team-hero-logo mb-4">
                <h1 class="section-title">Our Team</h1>
                <p class="lead">Meet our experienced leadership and management team</p>
            </div>
        </div>
        <div class="row">
            <?php if (count($teamMembers) > 0): ?>
                <?php foreach ($teamMembers as $member): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-member-card">
                            <div class="team-member-image mb-3">
                                <img src="<?php echo $member['image_path'] ?: 'assets/images/team-placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h5><?php echo htmlspecialchars($member['name']); ?></h5>
                            <p class="text-primary fw-bold"><?php echo htmlspecialchars($member['position']); ?></p>
                            <p class="text-muted small"><?php echo htmlspecialchars($member['bio']); ?></p>
                            <?php if (!empty($member['email'])): ?>
                                <p class="small"><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($member['email']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($member['phone'])): ?>
                                <p class="small"><i class="fas fa-phone me-2"></i><?php echo htmlspecialchars($member['phone']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php
                $staticTeam = [
                    [
                        'name' => 'David Banda',
                        'position' => 'Managing Director',
                        'bio' => 'Managing Director with extensive experience in civil works and general building maintenance. Holds various qualifications including project management and supervision in construction processes. Leads the company with a focus on quality delivery and customer satisfaction.',
                        'email' => 'david@ndawonga.co.za',
                        'phone' => '+27 79 486 8145'
                    ],
                    [
                        'name' => 'Dinah Modimakwane',
                        'position' => 'Chief Financial Officer (CFO)',
                        'bio' => 'Chief Financial Officer responsible for financial management, budgeting, and ensuring fiscal responsibility across all projects. Oversees financial operations and strategic financial planning for the co-operative.',
                        'email' => 'dinah@ndawonga.co.za',
                        'phone' => '+27 61 117 4354'
                    ],
                    [
                        'name' => 'Thato Manda',
                        'position' => 'Legal Director',
                        'bio' => 'Legal Director with LLB qualification, responsible for legal compliance, contract management, and ensuring all operations meet regulatory requirements. Also handles HR and PR functions for the company.',
                        'email' => 'thato@ndawonga.co.za',
                        'phone' => '+27 11 941 5913'
                    ],
                    [
                        'name' => 'Dr. Tamala Manda',
                        'position' => 'Construction Manager',
                        'bio' => 'Construction Manager with doctorate qualification, overseeing all construction projects from planning to completion. Ensures quality standards and project delivery within scope, cost, and schedule parameters.',
                        'email' => 'tamala@ndawonga.co.za',
                        'phone' => '+27 11 941 5913'
                    ],
                    [
                        'name' => 'Vusi Khanyile',
                        'position' => 'Sales and Marketing Manager',
                        'bio' => 'Sales and Marketing Manager responsible for business development, client relationships, and market expansion. Focuses on building relationships across government and commercial sectors.',
                        'email' => 'vusi@ndawonga.co.za',
                        'phone' => '+27 11 941 5913'
                    ],
                    [
                        'name' => 'Portia Mlonjane',
                        'position' => 'Safety Officer',
                        'bio' => 'Safety Officer responsible for implementing and maintaining occupational health and safety standards across all projects. Ensures compliance with safety regulations and promotes safety awareness among all staff.',
                        'email' => 'portia@ndawonga.co.za',
                        'phone' => '+27 11 941 5913'
                    ],
                    [
                        'name' => 'Mahlodi Garekwe',
                        'position' => 'Costing and Client Liaison',
                        'bio' => 'Costing and Client Liaison specialist responsible for project cost estimation, client communication, and ensuring accurate pricing and completion date estimates for all projects.',
                        'email' => 'mahlodi@ndawonga.co.za',
                        'phone' => '+27 11 941 5913'
                    ]
                ];
                foreach ($staticTeam as $member): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-member-card">
                            <div class="team-member-image mb-3">
                                <img src="assets/images/team-placeholder.jpg" alt="<?php echo htmlspecialchars($member['name']); ?>" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h5><?php echo htmlspecialchars($member['name']); ?></h5>
                            <p class="text-primary fw-bold"><?php echo htmlspecialchars($member['position']); ?></p>
                            <p class="text-muted small"><?php echo htmlspecialchars($member['bio']); ?></p>
                            <p class="small"><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($member['email']); ?></p>
                            <p class="small"><i class="fas fa-phone me-2"></i><?php echo htmlspecialchars($member['phone']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

