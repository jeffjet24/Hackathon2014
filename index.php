<!DOCTYPE html>
<html>
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        $('.body').hover(function(){
          $('.submenu').hide();
          $('.login').hide();
          $('.signup').hide();
        });
        $('.menu').hover(function(){
          $('.submenu').show();
        });
        $('.button').click(function(){
          $(this).fadeTo('slow',0.1);
          $(this).hide('slow');
        });
        $('body').hover(function(){
          $('.info').fadeTo('slow',0);
        });
        $('.info').hover(function(){
          $(this).fadeTo('slow',1);
        });
        $('.info').mouseleave(function(){
          $(this).fadeTo('slow',0);
        });
        $('.submenu').click(function(){
          $('.body').hide();
          $(this).hide();
          $('.menu').hide();
          $('.login').show();
        });
        $('.needaccount').click(function(){
            $('.login').hide();
            $('.signup').show();
        })
      });
    </script>
    <style>
      .submenu{
        text-align:right;
        background-color:#3f51b5;
        width:100px;
        position:absolute;
        right:25px;
        top:45px;
      }
      .button{
        height:200px;
        width:200px;
        display:inline-block;
        margin-top:auto;
        margin-bottom:auto;
        background-image:url("http://i.stack.imgur.com/12F8N.png");
      }
    </style>
  </head>
  <body style='background-color:#3f51b5'>
  <?php global $compBadges,$ptEarned,$nextLevel;
  $compBadges=5;
  $ptEarned=10;
  $nextLevel=20;
  ?>
    <div style='font-size:72px;display:inline-block;position:absolute;margin-left:20px'>
      AMAS
    </div>
    <div class='login' style='position:absolute;margin-left:40%;margin-right:40%;margin-top:150px'>
      <form style='text-align:center'>
            <div style ='background-color:#c5cae9;width:150px'>
              <p>Login</p>
              Username: <input type ='text'><br>
              Password: <input type='password'><br>
              <input type ='submit' style='background-color:#009688'><br>
              <a class='needaccount'>I don't have an account</a>
            </div>
        </form>
    </div>
    <div class='signup' style='position:absolute;margin-left:40%;margin-right:40%;margin-top:150px'>
        <form style='text-align:center'>
        <div style='background-color:#c5cae9;width:150px'>
        <p>Signup</p>
        Username: <input type = 'text'><br>
        Email: <input type = 'text'><br>
        Password: <input type='password'><br>
        Re-type Password: <input type = 'password'><br>
        <input type ="checkbox"> Would you like to recieve emails about new badges?<br>
        <input type = 'submit' style='background-color:#009688'>
        </div>
    </form>
    </div>
    <div style='text-align:right;height:70px;text-size:24px'>
      <div class='menu' style='margin-top:35px;margin-right:20px;margin-bottom:20px;display:block;background-color:#3f51b5'>
        Username
      </div>
    </div>
    <div>
      <p class='submenu' class='hi'>
        Log Off
      </p>
    </div>
  <div class='body' style='background-color:#c5cae9;min-height:1500px'>
    <center><p style='font-size:32px;display:inline-block;margin-left:20px;text-align:center'>
      New Badges
    </p></center>
    <p> 
    </p>
    <center>
    <?php
function CallGet($add,$key){
    // create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $add);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $key.":");
curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// grab URL and pass it to the browser
    $result=curl_exec($ch);
// close cURL resource, and free up system resources
    curl_close($ch);

    return $result;
}
function CallPOST($add,$key,$fields){
    // create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $add);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $key.":");
curl_setopt($ch, CURLOPT_POSTFIELDS, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// grab URL and pass it to the browser
    $result=curl_exec($ch);
// close cURL resource, and free up system resources
    curl_close($ch);

    return $result;
}
$info=[
  "recipient_email: jeffjet24@gmail.com",
  "badge_template_id: 8e1de128-df02-4f43-870f-a79fd87129a0"];
$issueBadge=CallPOST("https://sandbox.youracclaim.com/api/v1/organizations/b9c6023b-a963-4e07-b48c-db22c6abcd3a/badges","yNeJFVOmM4IPpmjPJBOk",$info);
//echo $issueBadge;
$getBadges= CallGet("https://sandbox.youracclaim.com/api/v1/organizations/b9c6023b-a963-4e07-b48c-db22c6abcd3a/badge_templates","yNeJFVOmM4IPpmjPJBOk");

$results=json_decode($getBadges,TRUE);
echo "<br><br>";
$met= $results['metadata'];
for($i=0;$i<$met['count'];$i++){
$tempAr=$results['data'];
$tempAr=$tempAr[$i];
$BadgeName=$tempAr['name'];
$badgeDes=$tempAr['description'];
//echo $BadgeName.' '.$badgeDes."<br>";
echo "<div class='button'>
      <div>
        <div class ='info' style='position:absolute;margin-left:40px;background-color:#c5cae9;height:50px,width:150px'>".
        wordwrap($badgeDes,18,"<br>")." 
        </div>
        <p style='text-align:center;margin-top:40%'>";
        if(strlen($BadgeName)>18){


        echo wordwrap($BadgeName,18,"<br>");
    }else{
        echo $BadgeName."<br>"."<br>";
    }
        echo "
        </p>
      </div>
    </div>";
    $compBadges=$compBadges+1;
    $ptEarned=$ptEarned+2;
    $nextLevel=$nextLevel-2;




}

/*
</p>
        <p style='text-align:center;margin-bottom:50%'>

8e1de128-df02-4f43-870f-a79fd87129a0
d8289990-d364-4da7-8000-fee8a2243408
*/

//b9c6023b-a963-4e07-b48c-db22c6abcd3a
?></center>
<center><p style='font-size:32px;display:inline-block;margin-left:20px;text-align:center'>
      Your Acheivements
    </p>
    <p>
    </p>
    <div class='counter' style='margin-right:40px;background-color:#30ACFF;height:250px;width:250px;border:9px solid black;margin-left:40px;display:inline-block'>
    <p style='text-align:center;margin-top:20px'>
      <h2>Number Completed Badges</h2>
      
      
      </p>
      <p style='text-align:center;margin-bottom:20px'>
      <h2><?php echo $compBadges; ?></h2>
      </p>
    </div>
    <div class='counter' style='margin-right:40px;background-color:#30ACFF;height:250px;width:250px;border:9px solid black;margin-left:40px;display:inline-block'>
      <p style='text-align:center;margin-top:20px'>
        <h2>Total Points Earned</h2>
        <p> </p>
        
        <br>
      </p>
      <p style='text-align:center;margin-bottom:20px'>
      <h2><?php echo $ptEarned; ?></h2>
      </p>
    </div>
    <div class='counter' style='margin-right:40px;background-color:#30ACFF;height:250px;width:250px;border:9px solid black;margin-left:40px;display:inline-block'>
      <p style='text-align:center;margin-top:20px'>
        <h2>Points to Next Level</h2>
        
        <br>
      </p>
      <p style='text-align:center;margin-bottom:20px'>
      <h2><?php echo $nextLevel; ?></h2>
      </p>
    </div>
  </div>
</center>
</body>
</html>
