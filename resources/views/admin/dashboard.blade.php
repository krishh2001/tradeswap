@extends('admin.layouts.admin')

@section('content')
    <div class="dashboard">
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-details">
                    <h3><span class="counter" data-count="{{ $totalUsers }}">0</span></h3>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="card-details">
                    <h3><span class="counter" data-count="{{ $totalOrders }}">0</span></h3>
                    <p>Total Orders</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-money-bill"></i></div>
                <div class="card-details">
                    <h3><span class="counter" data-count="{{ $totalWithdrawRequests }}">0</span></h3>
                    <p>Withdraw Requests</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-headset"></i></div>
                <div class="card-details">
                    <h3><span class="counter" data-count="{{ $totalTickets }}">0</span></h3>
                    <p>Support Tickets</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-count');
                    const duration = 1000; // in milliseconds
                    const start = 0;
                    const stepTime = Math.abs(Math.floor(duration / value));
                    let current = start;

                    const timer = setInterval(() => {
                        current += 1;
                        counter.innerText = current;

                        if (current >= value) {
                            counter.innerText = value;
                            clearInterval(timer);
                        }
                    }, stepTime);
                };

                animate();
            });
        });
    </script>
@endsection
