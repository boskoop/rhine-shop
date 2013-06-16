{{--
    admin_products.blade.php

    Variables needed:
    - products -> associative array with category=>product
--}}
@if(count($products) < 1)
            <p class="text-info">No products</p>
@else
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th colspan="3">Stocksize</th>
                  <th style="width: 20px; padding-left: 0px; padding-right: 0px"></th>
                </tr>
              </thead>
              <tbody>
@foreach($products as $product)
                <tr><?php $category = $product->category()->first(); ?>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ number_format($product->price / 100, 2) }}</td>
                  <td>{{ $product->stocksize }}</td>
                  <td style="padding-left: 4px; padding-right: 0px">
                    {{ Form::open(URL::to_route('stockadd', array($product->id)), 'POST', array('class' => 'form-inline', 'style' => 'margin-bottom: 0')) }}

                      <button class="btn btn-primary btn-mini" type="submit"><i class="icon-plus icon-white"></i></button>
                      {{ Form::token() }}

                    {{ Form::close() }}

                  </td>
                  <td style="padding-left: 4px; padding-right: 0px">
                    {{ Form::open(URL::to_route('stocksub', array($product->id)), 'POST', array('class' => 'form-inline', 'style' => 'margin-bottom: 0')) }}

                      <button class="btn btn-primary btn-mini" type="submit"><i class="icon-minus icon-white"></i></button>
                      {{ Form::token() }}
                      
                    {{ Form::close() }}

                  </td>
                  <td>
                    {{ Form::open(URL::to_route('deleteproduct', array($product->id)), 'POST', array('class' => 'form-inline', 'style' => 'margin-bottom: 0')) }}

                      <button href="#confirm-delete-product-{{ $product->id }}" type="button" data-toggle="modal" class="btn btn-mini btn-danger"><i class="icon-remove-sign icon-white" ></i></button>
                      <div id="confirm-delete-product-{{ $product->id }}" class="modal hide fade" style="text-align: left">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h3>Confirm</h3>
                        </div>
                        <div class="modal-body">
                          <p>This action can not be reverted!</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger"><i class="icon-remove-sign icon-white" ></i> Delete product</button>
                          <a href="#confirm-delete-product-{{ $product->id }}" role="button" class="btn" data-toggle="modal">Cancel</a>
                        </div>
                      </div>
                      {{ Form::token() }}

                    {{ Form::close() }}

                  </td>
                </tr>
@endforeach
                <tr style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
              </tbody>
            </table>
@endif
