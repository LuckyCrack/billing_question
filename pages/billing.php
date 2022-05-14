<div class="row">
    <div class="col-12 text-center my-3">
        <h3>Billing Page</h3>
    </div>
</div>
<form id="billing-form" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group my-2">
                <label class="mb-2" for="customer_email">Customer Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter Email">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group my-2">
                <div class="mb-3 mt-4">
                    <label for="">Billing Section</label>
                    <button id="add-field" class="btn btn-primary mx-3">Add New</button>
                </div>
                <ul id="inputList" class="list-group">
                    <li id="listItem" class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="product_id[]" placeholder="Enter Product Id">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="product_quantity[]" placeholder="Enter Quantity">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-5">
        <div class="col-12">
            <div class="row">
                <div class="col-12 my-2">
                    <label for="">Denominations</label>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">500</label>
                        <input type="number" class="form-control" name="500" placeholder="Count">
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">50</label>
                        <input type="number" class="form-control" name="50" placeholder="Count">
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">20</label>
                        <input type="number" class="form-control" name="20" placeholder="Count">
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">10</label>
                        <input type="number" class="form-control" name="10" placeholder="Count">
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">5</label>
                        <input type="number" class="form-control" name="5" placeholder="Count">
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">2</label>
                        <input type="number" class="form-control" name="2" placeholder="Count">
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="col-4">
                        <label for="">1</label>
                        <input type="number" class="form-control" name="1" placeholder="Count">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 my-3">
        <div class="form-group my-2">
            <label class="mb-2" for="cash_paid">Cash Paid by customer</label>
            <input type="text" class="form-control" id="cash_paid" name="cash_paid" placeholder="Amount">
        </div>
    </div>

    <div class="col-12 my-5 text-end">
        <button class="btn btn-outline-secondary px-5 me-2">Cancel</button>
        <button id="generate-bill" class="btn btn-success px-5">Generate Bill</button>
    </div>


</form>