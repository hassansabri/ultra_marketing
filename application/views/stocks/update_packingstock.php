 <?php ?>
 <div class="main-div">
	<div class="sub-div">
			Logs
	</div>
	<div ></div>
	<?php $this->load->view("stocks/packinglogs"); ?>
	</div>
 <div class="main-div">
	<div class="sub-div">
			Actions
	</div>
	<div class="row">
		<div class="col-md-2">
			<div class="form-group" id="">
				<input placeholder="Entry Date" type="text" name="entry_date" id="entry_date" style="width:100%"/>
            </div>
		</div>
		<div class="col-md-2">
			<div class="form-group" id="">
				<select name="stock_type" class="form-control" id="stock_type">
					<option value="0">Please Select</option>
					<option value="opening_balance">Opening Balance</option>
					<option value="stock_addition">Stock Addition</option>
				</select>
            </div>
		</div>
		<div class="col-md-2">
			<input placeholder="balance" type="text" name="quantity" id="balance" style="width:100%" />
		</div>
		
		<div class="col-md-2">
			<div class="form-group" id="">
				<button class="btn btn-default" onclick="packingstock.check();">
                    <i class="fa fa-eye"></i>check
                </button>/<button class="btn btn-default" onclick="packingstock.add();">
                    <i class="fa fa-plus"></i>Add
                </button>
            </div>
		</div>
		<div style="clear:both"></div>
	</div>
 </div>