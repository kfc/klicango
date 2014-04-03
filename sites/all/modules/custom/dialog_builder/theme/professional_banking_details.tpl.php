<div id="dialog-professional_banking_details" title="<?php echo t('My banking details'); ?>" width="484">
  <form method="post" action="/user/banking" enctype="multipart/form-data">
  	
    <div class="form-text">Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div>
    
    <div class="form-item long">
  		<label>Bank country</label>
  		<input type="text" name="country" placeholder="<?php echo t('ex: FRANCE')?>" value="<?php echo !(empty($data) && !empty($data['country'])) ? $data['country'] : ''; ?>" />
  	</div>
  	
   	<div class="form-item long">
  		<label>Bank account owner</label>
  		<input type="text" name="owner" placeholder="<?php echo t('ex: SOPHIE DURAND')?>" value="<?php echo !(empty($data) && !empty($data['owner'])) ? $data['owner'] : ''; ?>" />
  	</div>
    
   	<div class="form-item long">
  		<label>Bank agency name</label>
  		<input type="text" name="agency" placeholder="<?php echo t('ex: CIC')?>" value="<?php echo !(empty($data) && !empty($data['agency'])) ? $data['agency'] : ''; ?>" />
  	</div>

   	<div class="form-item long">
  		<label>IBAN</label>
  		<input type="text" name="iban" placeholder="<?php echo t('ex: FR761027804261000204461')?>" value="<?php echo !(empty($data) && !empty($data['iban'])) ? $data['iban'] : ''; ?>" />
  	</div>
    
   	<div class="form-item long">
  		<label>BIC (or SWIFT)</label>
  		<input type="text" name="bic" placeholder="<?php echo t('ex: CMCIFR2A')?>" value="<?php echo !(empty($data) && !empty($data['bic'])) ? $data['bic'] : ''; ?>" />
  	</div>

    
  	<div class="form-submit">
      <input type="submit" value="Update"/>
  	</div>
    <input type="hidden" name="user_type" value="7" />
  </form>
</div>
