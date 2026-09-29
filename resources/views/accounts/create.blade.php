<style type="text/css">
   .highlight-field {
   background: #f6c622;
   color: #382f2f;
   padding: 5px 10px;
   font-size: 13px;
   }
   .highlight-field  textarea
   {
   height: 70px;
   }
   .highlight-field span
   {
   font-weight: bold;
   color: #382f2f;
   }
   .widget
   {
   background: #fff;
   color: #000;
   }
   .lighted-div
   {
   background: #382f2f;
   padding: 10px 10px;
   color: #fff;
   }
   .lighted-div input
   {
   height: 21px!important;
   }
   .highlight-field input
   {
   height: 21px!important;
   }
   .highlight-field .form-group
   {
   margin-bottom:5px!important;
   }
   .blank_row
   {
   height: 10px;
   }
   .filter-container
   {
   background: #382f2f;
   padding: 6px;
   color: #fff;
   }
   .day-filter {
   background: #000;
   padding: 3px;
   margin-left: 5px;
   }
</style>
@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/account') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	
					</h3>
	                <br /> 
				</div>
			</div>
		</div>
		<div class="row">

			@if(Session::has('message'))
	            <div class="alert alert-success">
	                {{ Session::get('message') }}
	            </div>
	        @endif


			 <div class="row">
      <div class="col-sm-12">
         <div class="page-heading">
            <h3 class="heading text-center">COAM ENTERPRISES, LLC - WEEKLY SALES </h3>
         </div>
      </div>
   </div>
   <div class="filter-container">
      <div class="row">
         <div class="col-md-6">
            <label>Week No.</label>
            <span style="color: #f6c622;margin-left: 5px;font-weight: bold;">1234</span>
         </div>
         <div class="col-md-6 text-right">
            <label >Day/Date</label>
            <select class="day-filter">
               <option>Sat &nbsp; &nbsp;23-05-2015</option>
               <option>Sun &nbsp; &nbsp;23-05-2015</option>
               <option>Mon&nbsp; &nbsp;23-05-2015</option>
            </select>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
         <div class="widget form-layout">
            <div class="widget-content padding">
               <div class="row">
                  <div class="col-md-6">
                     <div class="lighted-div">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    DRYCLEANING
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    LAUNDRY
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    ALTERATIONS
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    LEATHER
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    HOUSEHOLD
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    RETAIL
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    PREPAID SALE
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    TOTALS (ALL)
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    OVER/(SHORT)
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="highlight-field">
                     	<div class="row">
                     		<div class="col-md-6">
                     			<div class="form-group row">
		                           <div class="col-md-5">
		                              DRYCLEANING
		                           </div>
		                           <div class="form-group col-md-7">
		                              <input type="text" class="form-control" name="" value="45">
		                           </div>
                               </div>
		                        <div class="form-group row">
		                           <div class="col-md-5">
		                              LAUNDRY
		                           </div>
		                           <div class="form-group col-md-7">
		                              <input type="text" class="form-control" name="" value="45">
		                           </div>
		                        </div>
                     		</div>
                     		<div class="col-md-6">
                     			 <div class="form-group row">
		                           <div class="col-md-5">
		                              LEATHER
		                           </div>
		                           <div class="form-group col-md-7">
		                              <input type="text" class="form-control" name="" value="45">
		                           </div>
		                        </div>
		                        <div class="form-group row">
		                           <div class="col-md-5">
		                              HOUSEHOLD
		                           </div>
		                           <div class="col-md-7">
		                              <input type="text" class="form-control" name="" value="45">
		                           </div>
		                        </div>
                     			
                     		</div>
                     	</div>

                        
                       
                        <div class="form-group row">
                           <div class="col-md-2">
                              <b>Note-</b>
                           </div>
                           <div class="col-md-12">
                              <textarea class="form-control">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="blank_row"></div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="lighted-div">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    CASH
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    COIN
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    CHECKS
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    CREDIT CARD
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    PREPAID SALE
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    TOTAL
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    NET TOTAL
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="lighted-div">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    SALES TAX
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    REFUNDS
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    COUPONS
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    DISCOUNTS
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    PREPAID SALE
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    EMPLOYEE
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-7">
                                    PAID OUT
                                 </div>
                                 <div class="col-md-5">
                                    <input type="text" class="form-control" name="">
                                 </div>
                              </div>
                           </div>
						   
                        </div>
                     </div>
                  </div>
               </div>
            </div>
							<div class="widget-footer">
								<button class="v-btn v-btn-primary">ADD</button>
							</div>
         </div>
      </div>
	  
		</div>
	</div>
</section>
@endsection
