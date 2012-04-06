<h1>Dashboard</h1>
<?php echo $this->element('SideMenu', array('legend' => 'dashboard')); ?>

<!-- BEGIN LEFT (MIDDLE) CONTENT COLUMN -->
<div id="leftContent">
	<?php if (isset($absences_today)): ?>
	<div id="dashboardAdmin">
		<h2>Today's Absences</h2>
		<div class="table">
			<div class="row">
				<span class="cell">Absentee</span>
				<span class="cell">Fulfiller</span>
				<span class="cell">Location</span>
				<span class="cell">Time</span>
			</div>
			<?php foreach ($absences_today as $absence): ?>
				<a class="rowLink" href="<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $absence['Absence']['id'])); ?>">
					<span class="cell"><?php echo "{$absence['Absentee']['first_name']} {$absence['Absentee']['last_name']}"; ?></span>
					<span class="cell"><?php echo "{$absence['Fulfiller']['first_name']} {$absence['Fulfiller']['last_name']}"; ?></span>
					<span class="cell"><?php echo "{$absence['School']['abbreviation']} {$absence['Absence']['room']}"; ?></span>
					<span class="cell"><?php echo date('g:i a', strtotime($absence['Absence']['start'])) . ' - ' . date('g:i a', strtotime($absence['Absence']['end'])); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>

  <!-- NEWS -->
  <div id="dashboardNews">
    <h2>News</h2>
    <ul id="dashboardNewsList">
      <a href="#">
      <li>
        <h3>March 9, 2012</h3>
        <p>More stuff happened</p>
      </li>
      </a> <a href="#">
      <li>
        <h3>February 29, 2012</h3>
        <p>Leap year happened</p>
      </li>
      </a> <a href="#">
      <li>
        <h3>February 14, 2012</h3>
        <p>Stuff happened</p>
      </li>
      </a>
    </ul>
  </div>

  <!-- CALENDAR -->
  <div id="dashboardCalendar">
    <h2>Calendar</h2>
    <p>No working calendar yet. Replace this part with some calendar widget.</p>
    <div style="height:300px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper leo nec est laoreet posuere. Maecenas a bibendum turpis. Sed tincidunt vulputate metus, sed suscipit elit aliquam vitae. Etiam quis vehicula ante. Quisque eleifend mattis lacus nec sodales. Mauris volutpat lectus ac magna vehicula malesuada. Aenean tristique lacinia turpis, at vulputate magna venenatis eget. Nam posuere nisl nec eros scelerisque ac elementum augue viverra. Nulla porttitor dapibus eros ut sagittis. Phasellus lacinia fermentum nunc, quis rhoncus justo auctor a. Aenean non dui ligula.</div>
  </div>
</div>
<!-- END LEFT (MIDDLE) CONTENT COLUMN -->

<!-- BEGIN RIGHT CONTENT COLUMN -->
<div id="rightContent">
  <h2>Overview</h2>
  <p>Today is <span class="date"><?php echo date('l, F j, Y'); ?></span>.<br />
    <?php if (isset($num_upcoming_absences)): ?>You have <span class="numAbsences"><?php echo $num_upcoming_absences > 0 ? $num_upcoming_absences : 'no'; ?></span> upcoming absence<?php echo $num_upcoming_absences == 1 ? '' : 's'; ?>. <br /><?php endif; ?>
    <?php if (isset($num_pending_absences)): ?>
      There <?php echo $num_pending_absences == 1 ? 'is' : 'are'; ?> <span class="numAbsences"><?php echo $num_pending_absences > 0 ? $num_pending_absences : 'no'; ?></span> absence<?php echo $num_pending_absences == 1 ? '' : 's'; ?> pending your approval.<br />
      <?php if ($num_pending_absences > 0) echo $this->Html->link('See pending absences.', array('controller' => 'absences', 'action' => 'pending')); ?><br />
    <?php endif; ?>

  <div id="dashboardNotificationList">
    <h4>Notifications</h4>

    <?php if (empty($notifications)): ?>
      <p>You have no notifications</p>
    <?php else: ?>
      <div class="table">
        <div class="row">&nbsp;</div>
        <?php foreach($notifications as $notification): ?>
          <a class="rowLink" href="<?php echo $this->Html->url(array('controller'=>'absences', 'action' => 'view', $notification['Absence']['id'])); ?>">
	    <span class="cell"><?php echo $this->Notification->printNotification($notification); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- ABSENCE AND APPLICANTS SIMPLE OVERVIEW -->
  <?php if (isset($absences)): ?>
    <div id="dashboardAbsenceList">
      <h4>Absences</h4>
  
      <!-- TABLE OF SIMPLIFED ABSENCE, CLICK TO OPEN CORRESPONDING ABSENCE EDIT PAGE -->
      <?php if (empty($absences)): ?>
        <p>You have no upcoming absences</p>
      <?php else: ?>
        <p>Below is a list of your upcoming absences. Click on an entry to view more information.</p>
        <div class="table">
          <div class="row">
            <span class="cell">Date</span>
            <span class="cell">Time</span>
            <span class="cell">Location</span>
            <span class="cell">Apps</span>
          </div>
          <?php foreach($absences as $absence): ?>
            <a class="rowLink" href=<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $absence['Absence']['id'])); ?>>
              <span class="cell"><?php echo date('D, M j Y', strtotime($absence['Absence']['start'])); ?></span>
              <span class="cell"><?php echo date('g:i a', strtotime($absence['Absence']['start'])); ?></span>
              <span class="cell"><?php echo $absence['School']['abbreviation'] . ' ' . $absence['Absence']['room']; ?></span>
              <span class="cell"><?php echo count($absence['Application']); ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (isset($applicants)): ?>
    <div id="dashboardApplicantsList">
      <h4>Applicants</h4>
  
      <!-- TABLE OF SIMPLIFED APPLICANTS, CLICK TO OPEN CORRESPONDING APPLICATION PAGE -->
      <?php if (empty($applicants)): ?>
        <p>No one has applied for your current absences</p>
      <?php else: ?>
        <p>Below is a list of your most recent applicants. Click on an entry to view more information.</p>
        <div class="table">
          <div class="row">
            <span class="cell">Substitute</span>
            <span class="cell">Absence</span>
            <span class="cell">Rating</span>
          </div>
          <?php foreach($applicants as $applicant): ?>
            <a class="rowLink" href=<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $applicant['User']['id'])); ?>>
              <span class="cell"><?php echo $applicant['User']['first_name'] . ' ' . $applicant['User']['last_name']; ?></span>
              <span class="cell"><?php echo date('M j g:i a', strtotime($applicant['Absence']['start'])); ?></span>
              <span class="cell">
                <?php
                  if ($applicant['User']['reviewer_count'] <= 0) echo '--';
                  else {
                    echo sprintf('%.1f', $applicant['User']['average_rating']);
                    echo " (by {$applicant['User']['reviewer_count']})";
                  }
                ?>
	      </span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <!-- END ABSENCE AND APPLICANTS SIMPLE OVERVIEW -->
</div>
<!-- END RIGHT CONTENT COLUMN -->
