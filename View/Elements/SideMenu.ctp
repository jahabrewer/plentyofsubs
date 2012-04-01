<div id="sidePanel">
  <p><?php echo isset($legend) ? $legend : 'dashboard'; ?></p>
  <ul id="sideNav">
    <?php
    echo $this->Html->link('<li>'.$this->Html->image('icons/create_absence.png').'Create Absence</li>', array('controller' => 'absences', 'action' => 'add'), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/manage_absence.png').'Manage Absence</li>', array('controller' => 'absences', 'action' => 'index'), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/view_applicants.png').'View Applicants</li>', array('controller' => 'absences', 'action' => 'index'), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/profile.png').'Profile</li>', array('controller' => 'users', 'action' => 'edit', $logged_in_userid), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/message.png').'Messages</li>', array('controller' => 'absences', 'action' => 'dashboard'), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/setting.png').'Account Settings</li>', array('controller' => 'users', 'action' => 'edit', $logged_in_userid), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Help</li>', array('controller' => 'pages', 'action' => 'display', 'help'), array('escape' => false));
    ?>
  </ul>
</div>
