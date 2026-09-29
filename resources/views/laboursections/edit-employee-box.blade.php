{!! Form::model($empData, array('route' => ['updateEmp'], 'method' => 'POST')) !!} 
<input type="hidden" name="header_id" value="{{ $headerid }}"> 
   <input type="hidden" name="id" value="{{ $empData->id }}"> 
      <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Edit Employee</h4>
         </div>
         <div class="modal-body">   
            <div class="container-fluid">
               <div class="widget-content">
                  <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                     <div class="col-sm-12">
                        <label for="name">PAYROLL EMPLOYEE</label>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="row form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                     <div class="col-sm-12">
                        <label for="salary">SALARY</label>
                        {!! Form::text('salary', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('salary'))
                        <span class="help-block">
                        <strong>{{ $errors->first('salary') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="row form-group{{ $errors->has('rateperhour') ? ' has-error' : '' }}">
                     <div class="col-sm-12">
                        <label for="rateperhour">PAYROLL EMPLOYEE RATE/HOUR</label>
                        {!! Form::text('rateperhour', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('rateperhour'))
                        <span class="help-block">
                        <strong>{{ $errors->first('rateperhour') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="row form-group{{ $errors->has('sorting_order') ? ' has-error' : '' }}">
                     <div class="col-sm-12">
                        <label for="sorting_order">PAYROLL DEPARTMENT SORTING NO.</label>
                        {!! Form::text('sorting_order', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('sorting_order'))
                        <span class="help-block">
                        <strong>{{ $errors->first('sorting_order') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>

                  
               </div>
            </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary submitBtn"  id="submitDep">SUBMIT</button>
            
          </div>
      </div>
   </form> 