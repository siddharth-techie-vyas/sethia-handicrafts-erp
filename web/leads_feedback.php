<?php //$query=$leads->get_feedback($_GET['id']);?>

			<!--- form -->
			<div class="col-md-12">
						<!-- /.box-header -->
                         <span id="msgleads_feedback_save"></span>
						<form class="form" method="post" action="<?php echo $base_url.'index.php?action=leads&query=leads_feedback_save'; ?>" name="leads_new" id="leads_feedback_save">
							<div class="box-body">
								<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
								<div class="row">
                                    
								  <div class="col-md-12">
									<div class="form-group">
									  <label>Feedback</label>
									  <textarea col="5" row="5" name="feedback" class="form-control"></textarea>
									</div>
								  </div>

                                  <div class="col-md-8">
									<div class="form-group">
                                        <input type="button" name="submit" onclick="form_submit('leads_feedback_save')" value="Save" class="btn btn-round btn-xs btn-info">
                                    </div>
                                    </div>  

                                    </div>
                                    
</form>

</div>
<hr class="my-10">
<div class="col-md-12">
    <?php $list=$leads->get_feedback_limit_5($_GET['id']);
    foreach($list as $row=>$value)
    {
        echo '<div class="alert alert-secondary alert-dismissable">'.$list[$row]['feedback'];
        echo '<br><small class="text-white">'.$list[$row]['date_time'].'</small>';
        echo '</div>';
    }
    ?>
</div>