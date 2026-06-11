<?php

$people = [
    [
        "name" => "Sameera",
        "role" => "Developer",
        "image" => "1.png",
        "skills" => ["PHP", "HTML", "CSS"]
    ],
    [
        "name" => "Sara",
        "role" => "Designer",
        "image" => "https://i.pravatar.cc/150?img=2",
        "skills" => ["Figma", "CSS", "UI"]
    ],
];


function getColor($index) {
    $colors = ["#ce93d8", "#80cbc4", "#ef9a9a", "#90caf9", "#a5d6a7"];
    return $colors[$index % count($colors)];
}


function countPeople($people) {
    return count($people);
}


$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$filteredPeople = [];
foreach ($people as $person) {
    if (empty($search) || stripos($person['name'], $search) !== false) {
        $filteredPeople[] = $person;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 01 - Profile Card Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f0f1a;
            color: #e0e0e0;
            line-height: 1.6;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #1a1a2e, #2d1b3d);
            padding: 30px 20px;
            text-align: center;
            border-bottom: 3px solid #ce93d8;
        }

        .header .logo-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 5px;
        }

        .header h1 span {
            color: #ce93d8;
        }

        .header p {
            color: #aaa;
            font-size: 0.95rem;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 15px 30px;
            text-align: center;
        }

        .stat-box .number {
            font-size: 2rem;
            font-weight: 800;
            color: #ce93d8;
        }

        .stat-box .label {
            font-size: 0.85rem;
            color: #888;
        }

        .search-form {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-form input[type="text"] {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 1rem;
            width: 300px;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .search-form input[type="text"]:focus {
            border-color: #ce93d8;
        }

        .search-form button {
            background: #ce93d8;
            color: #1a1a2e;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-left: 10px;
            font-family: 'Inter', sans-serif;
        }

        .search-form button:hover {
            background: #e1bee7;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .card-color-bar {
            height: 5px;
        }

        .card-body {
            padding: 25px;
            text-align: center;
        }

        .card-body img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid rgba(255, 255, 255, 0.1);
        }

        .card-body h3 {
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .card-body .role {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 12px;
        }

        .card-body .skills {
            color: #888;
            font-size: 0.85rem;
        }

        .card-body .skills span {
            display: inline-block;
            background: rgba(255, 255, 255, 0.05);
            padding: 3px 10px;
            border-radius: 12px;
            margin: 3px;
            font-size: 0.8rem;
        }

        .no-results {
            text-align: center;
            padding: 50px 20px;
            color: #666;
            font-size: 1.1rem;
        }

        .footer {
            text-align: center;
            padding: 30px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #555;
            font-size: 0.9rem;
        }

        .todo-notice {
            background: rgba(206, 147, 216, 0.08);
            border: 1px solid rgba(206, 147, 216, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .todo-notice h3 {
            color: #ce93d8;
            margin-bottom: 10px;
        }

        .todo-notice p {
            color: #b0b0c0;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo-row">
            <img src="https://alaqsa.edu.ps/site/MainPage/Resources/img/logo.png" alt="Al-Aqsa University"
                style="width:50px;height:50px;border-radius:10px;object-fit:contain;background:#fff;padding:3px;">
            <span style="color:#ccc;font-weight:600;">Al-Aqsa University</span>
        </div>
        <h1>Profile <span>Card Generator</span></h1>
        <p>Week 11 - Task 01: PHP Arrays, Functions & Loops</p>
    </div>

    <div class="container">

        
        <div class="todo-notice">
            <h3>Complete the TODOs!</h3>
            <p>Open this file in your code editor and complete all 6 TODOs in the PHP section at the top of the file.
            </p>
        </div>

        
        <div class="stats">
            <div class="stat-box">
                <div class="number"><?= countPeople($filteredPeople) ?></div>
                <div class="label">Total People</div>
            </div>
            <div class="stat-box">
                <div class="number"><?= date("Y-m-d") ?></div>
                <div class="label">Current Date</div>

            </div>
        </div>

        <form class="search-form" method="GET" action="">
        <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
         </form> 

        
<div class="cards-grid">
    <?php if (empty($filteredPeople)): ?>
        <div class="no-results">
            <p>No people found.</p>
        </div>
    <?php else: ?>
        <?php $i = 0; foreach ($filteredPeople as $person): ?>
            <div class="card">
                <div class="card-color-bar" style="background:<?= getColor($i) ?>;"></div>
                <div class="card-body">
                    <img src="<?= $person['image'] ?>" alt="<?= $person['name'] ?>">
                    <h3><?= $person['name'] ?></h3>
                    <div class="role" style="background:rgba(206,147,216,0.2);color:#ce93d8;">
                        <?= $person['role'] ?>
                    </div>
                    <div class="skills">
                        <?php foreach ($person['skills'] as $skill): ?>
    <span><?= $skill ?></span>
<?php endforeach; ?>
</div>
</div>
</div>
<?php $i++; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

    </div>

    <div class="footer">
        Al-Aqsa University - Web Development 1
    </div>

    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447"
        integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ=="
        data-cf-beacon='{"version":"2024.11.0","token":"a1dabd9b83e64f32bc03a4b3ded9fb02","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
        crossorigin="anonymous"></script>
</body>

</html>