<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Admin Dashboard</h2>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->order_number }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#customerModal{{ $customer->id }}">View</button>
                        @if (!$customer->approved)
                        <form action="{{ route('admin.approve', $customer->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        @else
                        <button class="btn btn-success" disabled>Approved</button>
                        @endif
                    </td>
                </tr>

                <div class="modal fade" id="customerModal{{ $customer->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="customerModalLabel{{ $customer->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="customerModalLabel{{ $customer->id }}">Customer Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Order Number:</strong> {{ $customer->order_number }}</p>
                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                <p><strong>Email:</strong> {{ $customer->email }}</p>
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset('storage/'.$customer->image_path) }}" class="img-fluid"
                                    alt="Proof of Payment">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>