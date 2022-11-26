<?php 
$score =  $_COOKIE['score'];
if(!isset($score)){
    setcookie("score", "0", time() + (86400 * 30), "/");
    $score =  $_COOKIE['score'];
}
$file = file_get_contents("./assets/data.json");
$data = json_decode($file, true);
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Learn Sign Language</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Icons -->
    <link rel="icon" sizes="any" type="image/svg+xml" href="/assets/images/favicon.svg">
    <link rel="alternate icon" type="image/x-icon" href="/assets/images/favicon.ico">

	<!-- Styles -->
	<link rel="stylesheet" href="/assets/styles/reset.css">
    <script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body>
	<header>
		<nav>
			<div class="max-w-6xl mx-auto py-8">
				<div class="relative flex flex-col sm:flex-row items-center justify-between space-y-8 sm:space-y-0"> 
                    <a href="/index.php" class="logo flex items-center text-2xl font-bold border-b-4">
                        <img src="/assets/images/logo.png">
                        Sign Together
                    </a>
					<div>
						<ul class="main-nav flex space-x-8 uppercase text-sm font-medium text-gray-800">
							<li><a href="/index.php" class="active hover:text-gray-600">Learn</a></li>
							<li><a href="/quiz.php" class="hover:text-gray-600">Quiz</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<section class="border border-gray-600 py-16 bg-pink-50" id="jumbotron">
	    <div class="max-w-6xl mx-auto text-center">
	        <h1 class="font-bold text-2xl mb-3">Learn sign language</h1>
	        <p>Learn the basics of sign language! Test your knowledge with our interactive quiz! Made by students, for students.</p>
	    </div>
	</section>
    <section class="max-w-6xl mx-auto py-8" id="alphabet">
        <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 gap-x-6 gap-y-8 pt-10 pb-16 sm:pt-11 md:pt-12">
            <?php foreach($data['alphabet'] as $letter){?>
            <div>
                <div class="relative h-[8.5rem]">
                    <div id="letter-<?php echo $letter['letter'];?>" aria-label="letter-<?php echo $letter['letter'];?>" aria-haspopup="true" aria-controls="letter-<?php echo $letter['letter'];?>" aria-expanded="false" class="absolute inset-0 flex h-full w-full cursor-auto items-center justify-center rounded-xl text-slate-900 ring-1 ring-inset ring-slate-900/[0.08]">
                        <span class="transition-transform duration-500 ease-in-out">
                        <img class="h-20" src="<?php echo $letter['img'];?>">
                        </span>
                    </div>
                </div>
                <div class="mt-3 truncate text-center text-[0.8125rem] leading-6 text-slate-500" title="letter-<?php echo $letter['letter'];?>">Letter: <?php echo $letter['letter'];?></div>
            </div>
            <?php }?>
        </div>
    </section>
</body>
</html>