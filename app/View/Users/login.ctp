

<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php 
        //echo $this->Form->input('username');
        //echo $this->Form->input('password');
        echo $this->Form->input('user_email_address');
        echo $this->Form->input('user_password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>


