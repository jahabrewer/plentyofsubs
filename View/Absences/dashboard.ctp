<h1>Dashboard</h1>
<?php echo $this->element('SideMenu', array('legend' => 'dashboard')); ?>

<!-- BEGIN LEFT (MIDDLE) CONTENT COLUMN -->
<div id="leftContent">

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
    You have <span class="unreadMail">1</span> unread message(s). <br />
    You have <span class="numAbsences"><?php echo $num_upcoming_absences > 0 ? $num_upcoming_absences : 'no'; ?></span> upcoming absence<?php echo $num_upcoming_absences == 1 ? '' : 's'; ?>. <br />
    There have been <span class="numTotalApplicants">1</span> applicant(s) for <span class="absencesWithApplicants">1</span> of my absence(s).</p>

  <div id="dashboardNotificationList">
    <h4>Notifications</h4>

    <?php if (empty($notifications)): ?>
      <p>You have no notifications</p>
    <?php else: ?>
      <table>
        <tr>
          <th>stuff</th>
        </tr>
        <?php foreach($notifications as $notification): ?>
          <tr>
            <td><?php echo $notification['Other']['first_name'] . ' ' . $notification['Other']['last_name'] . ' did ' . $notification['Notification']['notification_type'] . ' to your ' . date('M j', strtotime($notification['Absence']['start'])) . ' absence'; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
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
        <p>Below is a list of your nearest absences. Click on an entry to view more information.</p>
        <table>
          <tr>
            <th>Date</th>
            <th>Start</th>
            <th>Room</th>
            <th>Class</th>
            <th>Apps</th>
          </tr>
          <?php foreach($absences as $absence): ?>
            <tr>
              <td><?php echo date('D, M j Y', strtotime($absence['Absence']['start'])); ?></td>
              <td><?php echo date('g:i a', strtotime($absence['Absence']['start'])); ?></td>
              <td><?php echo $absence['School']['abbreviation'] . ' ' . $absence['Absence']['room']; ?></td>
              <td>Math</td>
              <td><?php echo count($absence['Application']); ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
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
        <table>
          <tr>
            <th>Substitute</th>
            <th>Absence</th>
            <th>Review</th>
            <th>City</th>
          </tr>
          <?php foreach($applicants as $applicant): ?>
            <tr>
              <td><?php echo $applicant['User']['first_name'] . ' ' . $applicant['User']['last_name']; ?></td>
              <td><?php echo date('M j g:i a', strtotime($applicant['Absence']['start'])); ?></td>
              <td>A</td>
              <td>Duluth</td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <!-- END ABSENCE AND APPLICANTS SIMPLE OVERVIEW -->
</div>
<!-- END RIGHT CONTENT COLUMN -->
