<div id="divGeneralScore" class="general-score pull-right" style="display:none;">
    <a><img alt="General Score" src="<?php echo(IMG.'score.png');?>">
        <p>Total Score</p>
        <i id="generalScore"></i>
    </a>
</div>

<div id="wrapper">
    <div id="sidebar-wrapper">
        <a class="twitter-timeline" href="https://twitter.com/hashtag/leagueoflegends" data-widget-id="728356451488387072">Tweets about #leagueoflegends</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
</div>

<!--boton de tuiter-->
<ul>
   <a href="#menu-toggle" id="menu-toggle"><img class="ver-tuits" alt="Trending Twitter" src="<?php echo(IMG.'twit.png');?>"></a>
</ul>
<!-- fin boton de tuiter -->

<ul id="side-menu" class="side-menu"></ul>

<div class="main-logo">
    <div class="logo">
        <img alt="Champion Mastery Data" src="<?php echo(IMG.'lol-champion-mastery-data.png');?>"> 
    </div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button id="btnCollapse" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Find a Summoner</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          
            <ul class="nav navbar-nav navbar-right">
              <?php echo validation_errors(); ?>
                <?php echo form_open('/', array('method'=>'get')); ?>
                
                    <li class="dropdown pull-left region-select">
                        <select id="region" name="region" class="form-control">
                          <?php foreach($regions as $region):?>
                            <option value="<?php echo $region['idcat_region']; ?>"
                              <?php if($region['idcat_region']==@$_GET['region']){
                                  echo "selected='selected'";
                              } ?>
                              ><?php echo $region['reg_region']; ?></option>
                          <?php endforeach;?>
                        </select>
                    </li>

                    <div class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                          <input id="summoner" name="summoner" type="text" class="form-control" value="<?php echo $summoner; ?>" placeholder="Summoner Name"/>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                   
              </form>
            </ul>
          
        </div>
  </div>
</nav>

<div id="champions">
  
</div>
<div class="loader">
    <img id="loadingImg" class="" src="<?php echo(IMG.'loading.gif');?>" style="display:none;">
</div>
<div class="container">
  <div id="champions">
  </div>
  <?php if($mastery=="null"){ ?>
      
  <?php } else if ($mastery=="notFound"){ ?> 
    <div class="alert alert-warning gap ">Summoner not found! :(</div>
  <?php } else if ($mastery=="noMasteryData" || $mastery=="[]"){ ?> 
    <div class="alert alert-warning gap ">No mastery data! :(</div>
  <?php } else  {?>
    <script type="text/javascript">
     var champions = <?php echo $mastery; ?>;
     var generalScore = <?php echo $generalScore; ?>;
     var championsLength = champions.length;
     var index = 0;

     getNextChampion(index, championsLength, champions);

    function getNextChampion(index, championsLength, champions){
      var champion = champions[index];
      $("#loadingImg").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/app/getChampionName",
        data: { id: champion.championId, 
          championLevel: champion.championLevel, 
          lastPlayTime:new Date(champion.lastPlayTime), 
          championPoints: champion.championPoints,
          championPointsUntilNextLevel: champion.championPointsUntilNextLevel,
          highestGrade: champion.highestGrade,
          chestGranted: champion.chestGranted }
      }).done(function( result ) {
          $( "#champions" ).append(result);
          index++;
          if(index<championsLength){
            getNextChampion(index, championsLength, champions );  
          }else{
            $("#loadingImg").hide();  
          }
      });
    }

    $("#generalScore").html(generalScore);
    $("#divGeneralScore").show();
  </script>
  <?php } ?>
   
</div>


<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#btnCollapse").click();
</script>