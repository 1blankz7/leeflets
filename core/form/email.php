<?php
class LF_Form_Email extends LF_Form_Text {
    function html($print = false) {
        if (!$print) ob_start();
        ?>
        
        <div class="field field-text field-email field-<?php echo $this->id; echo (!empty($this->errors)) ? ' field-error' : '' ?>">
            <label class="prime" for="<?php echo $this->id ?>"><?php echo $this->lbl; echo ($this->req) ? '<span class="req">*</span>' : '' ?></label>
            <input type="email" class="text email" id="<?php echo $this->id; ?>" name="<?php echo $this->name; ?>" value="<?php echo htmlentities($this->value, null, $this->fieldset->form->encoding) ?>"<?php $this->display_placeholder(); ?> />
            <?php $this->display_tip(); $this->display_errors(); ?>
        </div>
            
        <?php
        if (!$print) return ob_get_clean();
    }    
}
