<?php
session_start();
define("access",true);
include ("classes/controls.php");
$control=new controls();
if (!$control->isInternal())
{
    die("Invalid entry");
}
include("header.php");
require_once ("classes/leadClass.php");
$obj=new leadClass();
$role=$control->myRole();
$username=$control->loggedAs();
$limit = 10;
$page = 1;
if (isset($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
$clas1="uk-button-danger";
$clas2="uk-button-primary";
$clas3="uk-button-primary";
$status=0;
if($control->isClaimsSpecialist())
{
    $clas3="uk-button-danger";
    $status=2;
}

if(!isset($_SESSION['clas'])) {
    $_SESSION["clas"]="Active";
    $clas1="uk-button-danger";
    $clas2="uk-button-primary";
    $clas3="uk-button-primary";
    $status=0;
    if($control->isClaimsSpecialist())
    {
        $clas3="uk-button-danger";
        $status=2;
    }

}
if(isset($_GET["status"]))
{

    $status=$_GET["status"];
    if($status==2)
    {
        $clas1="uk-button-primary";
        $clas2="uk-button-primary";
        $clas3="uk-button-danger";
    }
    elseif ($status==1)
    {
        $clas1="uk-button-primary";
        $clas2="uk-button-danger";
        $clas3="uk-button-primary";
    }
}
if(isset($_POST["assessed"]))
{
    $clas1="uk-button-primary";
    $clas2="uk-button-danger";
    $clas3="uk-button-primary";
    $_SESSION["clas"]="Assessed";
    $status=1;

}
elseif (isset($_POST["signoff"]))
{
    $clas3="uk-button-danger";
    $clas1="uk-button-primary";
    $clas2="uk-button-primary";
    $_SESSION["clas"]="Signoff";
    $status=2;
}
elseif (isset($_POST["active"])){
    $clas3="uk-button-primary";
    $clas2="uk-button-primary";
    $clas1="uk-button-danger";
    $_SESSION["clas"]="Active";
    $status=0;
    if($role=="claims_specialist")
    {
        $clas3="uk-button-danger";
        $status=2;
    }

}

$val="";
if(isset($_POST['btnsearch']))
{
    $val=$_POST['search'];
    $statuss=0;
    if($_SESSION["clas"]=="Assessed")
    {
        $clas2="uk-button-danger";
        $clas1="uk-button-primary";
        $clas3="uk-button-primary";
        $statuss=1;

    }
    elseif($_SESSION["clas"]=="Signoff")
    {
        $clas3="uk-button-danger";
        $clas2="uk-button-primary";
        $clas1="uk-button-primary";
        $statuss=2;

    }
    else{

        $clas1="uk-button-danger";
        $clas2="uk-button-primary";
        $clas3="uk-button-primary";
        $statuss=0;
        if($role=="claims_specialist")
        {
            $clas3="uk-button-danger";
            $statuss=2;
        }
    }
    $pagn=$obj->getSearchQuality($val,$start_from, $limit,$statuss,$role,$username);
    $total_records=count($obj->getSearchAllQuality($val,$statuss,$role,$username));
}
else
{
    $pagn=$obj->getNewAllQuality($start_from, $limit,$status,$role,$username);
    $total_records=count($obj->getNewQuality($status,$role,$username));

}
$r1=count($obj->getNewQuality(0,$role,$username));
$r2=count($obj->getNewQuality(1,$role,$username));
$r3=count($obj->getNewQuality(2,$role,$username));


?>
<html>
<head>

    <title>MCA | Quality Assurance</title>
    <link rel="stylesheet" href="css/simplePagination.css" />
    <script src="js/jquery.simplePagination.js"></script>
<script src="js/qafeedback.js"></script>
    <style>
        .purp{
            color:rebeccapurple;
        }
        .uk-button{
            border-radius:15px

        }
        thead>tr>th{
            color: #54bc9c !important;
        }
        .w3-black{
            background-color: black !important;
        }
   .userclass{
            background-color: lightblue !important;
            padding-left:10px !important;
        }
      div.scroll {


            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
        }
        .linkButton {
            background: none;
            border: none;
            color: #0066ff;
            text-decoration: none;
            cursor: pointer;

        }
    </style>

</head>

<body>
<?php

echo "<br><br>";

?>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <p uk-margin>
            <?php
            if($role=="admin" || $role=="controller")
            {
                ?>
                <button name="active" class="uk-button <?php echo $clas1;?>"><span class="uk-badge w3-black"><?php echo $r1;?></span> Ready for QA</button>
                <?php
            }
            ?>
            <button name="signoff" class="uk-button <?php echo $clas3;?>"><span class="uk-badge w3-black"><?php echo $r3;?></span> Pending</button>
            <button name="assessed" class="uk-button <?php echo $clas2;?>"><span class="uk-badge w3-black"><?php echo $r2;?></span> Completed</button>
<button name="qafeedback" class="uk-button uk-button-secondary"> QA Feedback Sessions</button>

    </form>
   <?php
    if(isset($_POST["qafeedback"]))
    {
        require ("qa_feedback.php");
    }
    else
    {
    ?>
    <div class="uk-margin">
        <form class="uk-search uk-search-default" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <button name="btnsearch" class="uk-search-icon-flip" uk-search-icon></button>
            <input class="uk-search-input" name="search" value="<?php echo $val;?>" type="search" placeholder="Search...">
        </form>
    </div>
    <table class="uk-table uk-table-striped" width="100%">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Surname</th>
            <th>Claim Number</th>
            <th>Policy Number</th>
            <th>Username</th>
            <th>Client Name</th>

            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($total_records>0) {
            foreach ($pagn as $row) {
                $claim_id=$row[0];
                $zerro=count($obj->zeroAmounts($claim_id));
                $mmeb=count($obj->members($claim_id));
                $ffile=count($obj->updatedDocs($claim_id));
                $is="";
                if($zerro>0)
                {
                    $is="<li>This claim has zero amounts</li><li class=\"uk-nav-divider\"></li>";
                }
                if($mmeb>0)
                {
                    $is.="<li>The member still needs to be contacted.</li><li class=\"uk-nav-divider\"></li>";
                }

                if($ffile>0)
                {
                    $is.="<li>New files not opened.</li><li class=\"uk-nav-divider\"></li>";
                }
                if((int)$row[7]==2)
                {
                    $is.="<li>The claim had more than 2 days without notes</li>";
                }
                $gg=$obj->getDraft($claim_id)?"<span style='color: red'>*</span>":"";
                $sla="";
                if((int)$row[7]==2 || $zerro>0 || $mmeb>0 || $ffile>0)
                {
                    $sla="purp";
                }
                else{
                    $is="<li>No SLA issues on this claim</li>";
                }
                echo "<tr class='$sla' id='$claim_id'>";
                echo "<th>$gg$row[1]</th>";
                echo "<th>$row[2]</th>";
                echo "<th>$row[3]</th>";
                echo "<th>$row[4]</th>";
                echo "<th>$row[5]</th>";
                echo "<th>$row[6]</th>";

                echo "<th title='view assessment'><form action='quality_assurance.php' method='post'><input type='hidden' name='claim_id' value='$claim_id'/><button name='quality_btn' uk-icon=\"icon: star\" style='color:#54bc9c'></button></form></th>";
                echo "<th title='view details'><form action='case_details.php' method='post'><input type='hidden' name='claim_id' value='$claim_id'/><button name='btn' uk-icon=\"icon: info\" style='color:#54bc9c'></button></form></th>";
                echo "<th><span uk-icon=\"icon: bolt\" style='color:#54bc9c'></span><div uk-dropdown><ul class=\"uk-nav uk-dropdown-nav\">$is</ul></div></th>";
                echo "<th><button class='uk-button move_to_completed' data='$claim_id'>Push</button></th></tr>";
            }
        }
        else{
            echo "<tr style='background-color: white'><th colspan='7' class='uk-text-light'>No records</th></tr>";
        }
        ?>
        </tbody>
    </table>
    <?php

    $total_pages = ceil($total_records / $limit);
    $pagLink = "<nav><ul class='pagination'>";
    for ($i=1; $i<=$total_pages; $i++) {
        $pagLink .= "<li><a href='view_quality.php?page=".$i."&status=".$status."'>".$i."</a></li>";
    };
    echo $pagLink . "</ul></nav>";
  }
    ?>

</div>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('.pagination').pagination({
            items: <?php echo $total_records;?>,
            itemsOnPage: <?php echo $limit;?>,
            cssStyle: 'light-theme',
            currentPage : <?php echo $page;?>,
            hrefTextPrefix : 'view_quality.php?status=<?php echo $status;?>&page='
        });
    });
</script>

