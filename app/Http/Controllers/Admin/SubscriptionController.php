<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    // List all subscriptions
    public function index()
    {
        $subscriptions = Subscription::latest()->get();
        return view('admin.subscription.index', compact('subscriptions'));
    }

    // Show the create form
    public function create()
    {
        return view('admin.subscription.create');
    }

    // Store a new subscription
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan_name'      => 'required|string|max:255',
            // 'actual_price'   => 'required|numeric|min:0',
            'price'          => 'required|numeric|min:0',
            'validity_days'  => 'required|integer|min:1',
            'reward_limit'   => 'required|numeric|min:1',
            'description'    => 'nullable|string',
        ]);

        Subscription::create($validated);

        return redirect()->route('admin.subscription.index')
            ->with('success', 'Subscription plan created successfully.');
    }

    // Show a specific subscription
    public function view($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('admin.subscription.view', compact('subscription'));
    }

    // Show the edit form
    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('admin.subscription.edit', compact('subscription'));
    }

    // Update a subscription
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'plan_name'      => 'required|string|max:255',
            // 'actual_price'   => 'required|numeric|min:0',
            'price'          => 'required|numeric|min:0',
            'validity_days'  => 'required|integer|min:1',
            'reward_limit'   => 'required|numeric|min:1',
            'description'    => 'nullable|string',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->update($validated);

        return redirect()->route('admin.subscription.index')
            ->with('success', 'Subscription plan updated successfully.');
    }

    // Delete a subscription
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.subscription.index')
            ->with('success', 'Subscription plan deleted successfully.');
    }
}
