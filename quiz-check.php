<?php 
if($_POST){
$cookie_name = "letter".$_POST['letter'];
$cookie_actual = $_COOKIE[$cookie_name];
$score =  intval($_COOKIE['score']);
$answered = 0;
if(($_POST['letter'] == ucfirst($_POST['answer'])) && !isset($cookie_actual)){
    $score += 1;
    setcookie($cookie_name, "1", time() + (86400 * 30), "/");
    setcookie("score", $score, time() + (86400 * 30), "/");
    $correct = true;
}elseif(!isset($cookie_actual)){
    setcookie($cookie_name, "2", time() + (86400 * 30), "/");
    $correct = false;
}
$file = file_get_contents("./assets/data.json");
$data = json_decode($file, true);
foreach($data['alphabet'] as $letter){
    $letter_cookie_name = 'letter'.$letter['letter'];
    $letter_cookie = $_COOKIE[$letter_cookie_name];
    if($letter['letter'] == $_POST['letter']){
        $img = $letter['img'];
    }
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
    <section class="max-w-6xl mx-auto pb-8" id="learn">
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
                <a href="/score.php" class="whitespace-nowrap font-medium text-pink-700 hover:text-pink-600">
                  Details
                  <span aria-hidden="true"> &rarr;</span>
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-center flex-col">
            <?php if($correct){?>
            <h2 class="font-bold text-xl">Your answer was correct!</h2>
            <p>This gesture represents the letter "<?php echo $_POST['letter'];?>".</p>
            <?php }else{?>
            <h2 class="font-bold text-xl">Uh oh, that wasn't the right answer!</h2>
            <p>This gesture represents the letter "<?php echo $_POST['letter'];?>". You guessed "<?php echo ucfirst($_POST['answer']);?>".</p>
            <?php }?>
            <img class="my-4" style="max-width: 200px" src="<?php echo $img;?>">
            <a href="./quiz.php" class="mt-2 justify-center inline-flex items-center rounded-md border border-transparent bg-pink-100 px-4 py-2 text-sm font-medium text-pink-700 hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2" style="width: 200px;">Try another question</a>
        </div>
    </section>
</body>
</html>
<?php }else{
   header("Location: https://signlang.srod.ca");
}?>