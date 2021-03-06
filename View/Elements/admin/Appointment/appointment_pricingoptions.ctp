<?php $attributes = array('legend' => false); ?>

<div id='PriceDurationId'>
<?php if(isset($ServicePricingOptions) && count($ServicePricingOptions)>0){
       $i=1;
       //pr($ServicePricingOptions); die;
       foreach($ServicePricingOptions as $ServicePricingOptions){
            
            if($i==1){ $checked='checked'; $required='required'; $pricemessage='Please enter price';
                    $durationmessage='Please enter duration';
            }else{
                $checked=false; $required=false; $pricemessage=''; $durationmessage='';    
            }
            if($ServicePricingOptions['ServicePricingOption']['sell_price']==''){
                 $selling_price=$ServicePricingOptions['ServicePricingOption']['full_price'];
            }
            else{
                 $selling_price=$ServicePricingOptions['ServicePricingOption']['sell_price']; 
            } ?>
        <div id='PriceDurationBlock col-sm-12'>
            <div class='form-group col-sm-1'>
                <input type='radio' <?php echo $checked?> name='data[Appointment][check]' id='OptionsSelectPlan_<?php echo $i; ?>' value="<?php echo $i; ?>" onclick='add_validation(this.value);'>
                <label class='new-chk' for='OptionsSelectPlan_<?php echo $i; ?>'></label>
            </div>
            <div class='form-group col-sm-5 rgt-p-non'>
                <label class='control-label'>Price*:</label>
                <?php echo $this->Form->input('Appointment.price_'.$i,array('class'=>'form-control remove','div'=>false,'label'=>false,'value'=>$selling_price,'required'=>$required,'onkeypress'=>'return validateFloatKeyPress(this,event);','maxlength'=>'8','validationmessage'=>$pricemessage)); ?>
            </div>
            <div class='form-group col-sm-5 rgt-p-non'>
                <label class='control-label'>Dur<dfn>(mins)</dfn>*:</label>
                <?php echo $this->Form->input('Appointment.duration_'.$i,array('class'=>'form-control remove numOnly','div'=>false,'label'=>false,'maxlength'=>'3','value'=>$ServicePricingOptions['ServicePricingOption']['duration'],'required'=>$required,'validationmessage'=>$durationmessage)); ?>
                <?php echo $this->Form->input('Appointment.points_redeem_'.$i,array('class'=>'form-control remove numOnly','div'=>false,'type'=>'hidden','label'=>false,'maxlength'=>'3','value'=>$ServicePricingOptions['ServicePricingOption']['points_redeem'])); ?>
                <?php echo $this->Form->input('Appointment.points_given_'.$i,array('class'=>'form-control remove numOnly','div'=>false,'type'=>'hidden','label'=>false,'maxlength'=>'3','value'=>$ServicePricingOptions['ServicePricingOption']['points_given'])); ?>
            
            </div>
            
            </div>
        <?php 
        $i++;
        }
    }elseif(isset($price_duration) && count($price_duration)>0){
       $checked='checked';
       ?>
        <div id='PriceDurationBlock col-sm-12'>
            <div class='form-group col-sm-1'>
                <input type='radio'  checked name='data[Appointment][check]' id='OptionsSelectPlan' value='1'>
                <label class='new-chk' for='OptionsSelectPlan'></label>
            </div> 
            <div class='form-group col-sm-5 rgt-p-non'><label class='control-label'>Price*:</label>
                <?php echo $this->Form->input('Appointment.price_1',array('class'=>'form-control remove','div'=>false,'label'=>false,'onkeypress'=>'return validateFloatKeyPress(this,event);','maxlength'=>'8','value'=>$edit_appointment['Appointment']['appointment_price'])); ?>
            </div>
            <div class='form-group col-sm-5 rgt-p-non'><label class='control-label'>Dur<dfn>(mins)</dfn>*:</label>
                <?php $theDuration = $edit_appointment['Appointment']['appointment_duration'];
                echo $this->Form->input('Appointment.duration_1',array('class'=>'form-control numOnly','div'=>false,'label'=>false,'value'=>$theDuration,'maxlength'=>'3')); ?>
            </div>
        </div>
    <?php 
 }
    else{ ?>
        <div id='PriceDurationBlock col-sm-12 nopadding'>
            <div class='form-group col-md-1'>
                <input type='radio' checked="checked" name='data[Appointment][check]' id='OptionsSelectPlan_1' value='1'>
                <label class='new-chk' for='OptionsSelectPlan_1'></label>
            </div>
            <div class='form-group col-md-5 rgt-p-non'>
                <label class='control-label'>Price*:</label>
                <?php echo $this->Form->input('price_1',array('class'=>'form-control remove','div'=>false,'label'=>false,'required','ValidationMessage'=>'Please enter price.','maxlength'=>'8','onkeypress'=>'return validateFloatKeyPress(this,event);','pattern'=>'^[1-9]\d*(\.\d+)?$')); ?>
            </div>
            <div class='form-group col-md-5 rgt-p-non'>
                <label class='control-label'>Dur<dfn>(mins)</dfn>*:</label>
                <?php echo $this->Form->input('duration_1',array('class'=>'form-control numOnly','div'=>false,'label'=>false,'required','ValidationMessage'=>'Please enter duration.','maxlength'=>'3')); ?>
            </div>
        </div>
    <?php } ?>
</div>
<script>


$(document).on('keyup','.numOnly' ,function(){
        var value = $(this).val();
	if(isNaN(value)){
            $(this).val('');
        }
    });   



function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}
</script>