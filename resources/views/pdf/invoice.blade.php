


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .container {
    max-width: 1200px;
    padding-left: 15px;
    padding-right: 15px;
}
.col-lg-9 {
    flex: 0 0 auto;
    width: 75%;
}
.container .row {
    margin-left: -15px;
    margin-right: -15px;
}
.table {
    --bs-table-bg: transparent;
    --bs-table-striped-color: #212529;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: #212529;
    --bs-table-active-bg: rgba(0, 0, 0, 0.1);
    --bs-table-hover-color: #212529;
    --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    vertical-align: top;
    border-color: #dee2e6;
}
.table>tbody {
    vertical-align: inherit;
}
tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
    </style>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <table class="table table-bordered">
                <tbody><tr>

                    <th>Order id</th>
                    <th>Grand Total</th>
                    <th>Payment status</th>
                    <th>Payment option</th>

                </tr>
                <tr>
                    @foreach (Order_summeries() as $Order_summery)
                    <tr>
                        <td class="text-center">{{$Order_summery->id}}</td>
                        <td class="text-center">${{$Order_summery->grand_total}}</td>
                        <td class="text-{{$Order_summery->payment_status == 0 ? 'danger': 'success'}}">
                            {{$Order_summery->payment_status == 0 ? 'Unpaid': 'paid'}}

                        </td>
                        <td class="text-center">{{$Order_summery->payment_option == 0 ? 'Cash on Delivery': 'Online payment'}}</td>

                    </tr>
                    @endforeach
                </tr>

            </tbody></table>
        </div>

    </div>
</div>

</body>
</html>
