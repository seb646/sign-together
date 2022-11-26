<?php 
$file = file_get_contents("./assets/data.json");
$data = json_decode($file, true);
if($_GET['reset'] && ($_GET['reset'] == true)){
    foreach($data['alphabet'] as $letter){
        setcookie("letter".$letter['letter'], null, -1, '/'); 
    }
    setcookie("score", "0", time() + (86400 * 30), "/");
    header("Location: http://signlang.srod.ca/score.php");
}
$score =  $_COOKIE['score'];
if(!isset($score)){
    setcookie("score", "0", time() + (86400 * 30), "/");
    $score =  $_COOKIE['score'];
}
$answered = 0;
foreach($data['alphabet'] as $letter){
    $letter_cookie_name = 'letter'.$letter['letter'];
    $letter_cookie = $_COOKIE[$letter_cookie_name];
    if(isset($letter_cookie)){
        $answered += 1; 
    }
}
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
							<li><a href="/index.php" class="hover:text-gray-600">Learn</a></li>
							<li><a href="/quiz.php" class="active hover:text-gray-600">Quiz</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
    <section class="max-w-6xl mx-auto pb-8" id="alphabet">
        <div class="rounded-md bg-pink-50 p-4 mb-8">
          <div class="flex">
            <div class="flex-shrink-0">
              <!-- Heroicon name: mini/information-circle -->
              <svg class="h-5 w-5 text-pink-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M19 10.5a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0zM8.25 9.75A.75.75 0 019 9h.253a1.75 1.75 0 011.709 2.13l-.46 2.066a.25.25 0 00.245.304H11a.75.75 0 010 1.5h-.253a1.75 1.75 0 01-1.709-2.13l.46-2.066a.25.25 0 00-.245-.304H9a.75.75 0 01-.75-.75zM10 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
              <p class="text-sm text-pink-700">You've recognized <?php echo $score;?> out of <?php echo $answered;?> gestures.</p>
              <p class="mt-3 text-sm md:mt-0 md:ml-6">
                <a href="/score.php?reset=true" class="whitespace-nowrap font-medium text-pink-700 hover:text-pink-600">
                  Reset Score
                </a>
              </p>
            </div>
          </div>
        </div>

        <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-2 gap-x-6 gap-y-8">
            <?php foreach($data['alphabet'] as $letter){
            $letter_cookie = $_COOKIE['letter'.$letter['letter']];
            if(isset($letter_cookie) && ($letter_cookie == 1)){
                $correct = 1;
            }elseif(isset($letter_cookie)){
                $correct = 2;
            }else{
                $correct = 0;
            }
            ?>
            <div>
                <div class="relative h-[8.5rem]">
                    <div class="absolute top-2 right-2">
                    <?php if($correct == 1){?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-600">
                      <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                    </svg>
                    <?php }elseif($correct == 2){?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-600">
                      <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                    </svg>
    
                    <?php }elseif($correct == 0){?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                      <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm3 10.5a.75.75 0 000-1.5H9a.75.75 0 000 1.5h6z" clip-rule="evenodd" />
                    </svg>
                    <?php }?>
                    </div>
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