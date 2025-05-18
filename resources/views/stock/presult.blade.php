<div class="table-responsive">
    <table id="laravel_datatable" class="table" style="width: 100%">
        <thead>
            <tr>
                <th>Stock details</th>
                <th>{{ 'Total Quantity' }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $item)
                <tr>
                    <td>
                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Suplier Name</th>
                                    <th>Batch No.</th>
                                    <th>Expiry Date</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->details as $details)
                                    <tr>
                                        <td>{{ $item->product->dosage->name ?? 'N/A' }} : {{ $item->product->name ?? 'N/A' }} - {{ $item->product->strength ?? 'N/A' }}</td>
                                        <td>{{ $details->suplier->name ?? 'N/A' }}</td>
                                        <td>{{ $details->batch_no }}</td>
                                        <td>{{ $details->expired_date->format('d-m-Y') }}</td>
                                        <td>{{ $details->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </td>
                    <td>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Group Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $item->total_quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
{!! $data->render() !!}
