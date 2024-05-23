<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\PaymentGateway\Update;
use Illuminate\Support\Facades\Gate;

class PaymentGatewayController extends Controller
{
    /**
     * Display Payment Gateway Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        Gate::authorize('update online payment gateway');

        return view('application.settings.payment.gateways.edit', [
            'gateway' => $request->gateway,
        ]);
    }

    /**
     * Update the Gateway Settings
     *
     * @param \App\Http\Requests\Application\Settings\PaymentGateway\Update $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        Gate::authorize('update online payment gateway');

        // Update each settings in database
        foreach ($request->validated() as $key => $value) {
            $request->currentCompany->setSetting($key, $value);
        }

        session()->flash('alert-success', __('messages.gateway_updated'));
        return redirect()->route('settings.payment.gateway.edit', [
            'gateway' => $request->gateway, 
            'company_uid' => $request->currentCompany->uid
        ]);
    }
}
