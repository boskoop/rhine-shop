{{--
    admin_orders.blade.php

    Variables needed:
    - categories -> the categories
--}}
@if(count($categories) < 1)
            <p class="text-info">{{ __('rhine/account.no_categories') }}</p>
@else
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Category</th>
                  <th>Order</th>
                  <th style="width: 20px; padding-left: 0px; padding-right: 0px"></th>
                </tr>
              </thead>
              <tbody>
@foreach($categories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->order }}</td>
                  <td>
                    {{ Form::open(URL::to_route('deletecategory', array($category->id)), 'POST', array('class' => 'form-inline', 'style' => 'margin-bottom: 0')) }}

                      <button href="#confirm-delete-category-{{ $category->id }}" type="button" data-toggle="modal" class="btn btn-mini btn-danger"><i class="icon-remove-sign icon-white" ></i></button>
                      <div id="confirm-delete-category-{{ $category->id }}" class="modal hide fade" style="text-align: left">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h3>Confirm</h3>
                        </div>
                        <div class="modal-body">
                          <p>All products of the category will be deleted if you delete the category</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger"><i class="icon-remove-sign icon-white" ></i> Delete category</button>
                          <a href="#confirm-delete-category-{{ $category->id }}" role="button" class="btn" data-toggle="modal">Cancel</a>
                        </div>
                      </div>
                      {{ Form::token() }}

                    {{ Form::close() }}

                  </td>
                </tr>
@endforeach
                <tr style="background-color: #f9f9f9">
                  <td colspan="4"></td>
                </tr>
                {{ Form::open(URL::to_route('addcategory'), 'POST', array('class' => 'form-inline', 'style' => 'margin-bottom: 0')) }}
                  <tr>
                    <td></td>
                    <td>{{ Form::text('category', '', array('required', 'style' => 'margin-bottom: 0', 'placeholder' => 'New category')) }}</td>
                    <td></td>
                    <td>
                      <button class="btn btn-success btn-mini" type="submit"><i class="icon-plus-sign icon-white"></i></button>
                      {{ Form::token() }}

                    </td>
                  </tr>
                {{ Form::close() }}

              </tbody>
            </table>
@endif
