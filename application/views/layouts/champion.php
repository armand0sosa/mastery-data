<div id="div<?php echo $championKey; ?>" class="air-dimenciones air-back" style="background-image: url(http://ddragon.leagueoflegends.com/cdn/img/champion/splash/<?php echo $championKey; ?>_0.jpg);">
  <div class="opacidad"></div>
  <div class="container air-content text-center">
      <img class="avatar" alt="" src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/<?php echo $championKey; ?>.png">
      <h1><?php echo $championName; ?></h1>
      
      <ul id="listSpells<?php echo $championKey; ?>" class="spells"></ul>
       
      <div class="col-md-12 box-champion-data">
          <div class="col-md-12">
              <p>Champion Level:<i><?php echo $championLevel; ?></i></p>
              <p>Last play time: <i><?php echo $lastPlayTime; ?></i></p>
              <p>Champion points:<i><?php echo $championPoints; ?></i></p>
              <p>Champion points until next level:<i><?php echo $championPointsUntilNextLevel; ?></i></p>
              <p>Champion highest grade:<i><?php echo $highestGrade; ?></i></p>
              <p>Chest granted:</p>
          </div>
          <div class="col-md-12 box-img">
              <?php if($chestGranted=="true") {?>
                <img class="treasure" alt="treasure" src="<?php echo(IMG.'treasure.png');?>"/> 
              <?php } else {?>
                <img class="treasure" alt="No treasure" src="<?php echo(IMG.'treasure-no.png');?>"/> 
              <?php } ?>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
  $("#side-menu").append("<li> <a id='link<?php echo $championKey; ?>' href='#div<?php echo $championKey; ?>' class='list-item page-scroll'><img alt='' src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/<?php echo $championKey; ?>.png'></a> </li>");

  //jQuery for page scrolling feature - requires jQuery Easing plugin
  $(function() {
      $('#link<?php echo $championKey; ?>').bind('click', function(event) {
          var $anchor = $(this);
          $('html, body').stop().animate({
              scrollTop: $($anchor.attr('href')).offset().top
          }, 1500, 'easeInOutExpo');
          event.preventDefault();
      });
  });

  $("#listSpells<?php echo $championKey; ?>").append("<li data-toggle='tooltip' data-placement='top' data-html='true' title=\"<?php echo htmlspecialchars($passiveDescription, ENT_QUOTES); ?>\"><img alt='Spell'  src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/passive/<?php echo $passiveImage; ?>'> </li>");
  $("#listSpells<?php echo $championKey; ?>").append("<li data-toggle='tooltip' data-placement='top' data-html='true' title=\"<?php echo htmlspecialchars($spellDescription1, ENT_QUOTES); ?>\"><img alt='Spell' src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/<?php echo $spell1; ?>'> </li>");
  $("#listSpells<?php echo $championKey; ?>").append("<li data-toggle='tooltip' data-placement='top' data-html='true' title=\"<?php echo htmlspecialchars($spellDescription2, ENT_QUOTES); ?>\"><img alt='Spell' src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/<?php echo $spell2; ?>'> </li>");
  $("#listSpells<?php echo $championKey; ?>").append("<li data-toggle='tooltip' data-placement='top' data-html='true' title=\"<?php echo htmlspecialchars($spellDescription3, ENT_QUOTES); ?>\"><img alt='Spell' src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/<?php echo $spell3; ?>'> </li>");
  $("#listSpells<?php echo $championKey; ?>").append("<li data-toggle='tooltip' data-placement='top' data-html='true' title=\"<?php echo htmlspecialchars($spellDescription4, ENT_QUOTES); ?>\"><img alt='Spell' src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/<?php echo $spell4; ?>'> </li>");

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
</script>