<div id="sidePanel">
  <p><?php echo isset($legend) ? $legend : 'absence'; ?></p>
  <ul id="sideNav">
    <?php
    echo $this->Html->link('<li>'.$this->Html->image('icons/apply_absence.png').'Apply</li>', array('controller' => 'absences', 'action' => 'apply', $absence['Absence']['id']), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/retract_application.png').'Retract App</li>', array('controller' => 'absences', 'action' => 'retract', $absence['Absence']['id']), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/approve.png').'Approve</li>', array('controller' => 'absences', 'action' => 'approval', $absence['Absence']['id']), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/deny.png').'Deny</li>', array('controller' => 'absences', 'action' => 'denial', $absence['Absence']['id']), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/edit.png').'Edit</li>', array('controller' => 'absences', 'action' => 'edit', $absence['Absence']['id']), array('escape' => false));
    echo $this->Html->link('<li>'.$this->Html->image('icons/delete.png').'Delete</li>', array('controller' => 'absences', 'action' => 'delete', $absence['Absence']['id']), array('escape' => false), 'Are you sure you want to delete this absence?');
    echo $this->Html->link('<li>'.$this->Html->image('icons/help.png').'Help</li>', array('controller' => 'pages', 'action' => 'display', 'help'), array('escape' => false));
    ?>
  </ul>
</div>
