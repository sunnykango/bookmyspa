<?php
echo $this->Form->input('brand_id',  array('name'=>'data[Product][brand_id]','label'=>false,'div'=>false,'options' =>$brands,'class'=>'form-control','onChange'=>'product_list(this)','empty'=>'Please select','required','validationMessage'=>"Please select Brand Name."));  ?>