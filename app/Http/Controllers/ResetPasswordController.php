<?php


namespace App\Http\Controllers;


use App\Http\Utils\MailUtils;
use App\Http\Utils\SecureUtil;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController
{

    public function sendMail(Request $request)
    {

        $username = $request["username"];
        $accountToReset = UserAccount::query()
            ->where("username", "=", $request["username"])
            ->first(["email", "salt", "password"]);

        if (null != $accountToReset) {

            MailUtils::sendMailResetPassword($accountToReset->email, $username, config("app.url")."/reset/request/" . $accountToReset->password);

            return redirect('/')->with('message', "Your request was sent, please check your email.");
        } else {
            return redirect('/reset/request')->with('message', "Entered username not found in systems.");
        }

    }

    public function requestForReset(Request $request)
    {
        $rawNewPass = $request["password1"];
        $rawNewPass2 = $request["password2"];
        $oldPass = $request["reset_token"];

        if ($rawNewPass != $rawNewPass2) {
            return Redirect::back()->with('message', "Password mismatch.");
        }

        $accountToReset = UserAccount::query()
            ->where("password", "=", $oldPass)
            ->first(["account_id", "username", "email"]);

        if (null != $accountToReset) {

            $newSalt = SecureUtil::generateRandomString();
            $newPassword = SecureUtil::hashing([$accountToReset->username, $rawNewPass, $newSalt]);

            UserAccount::query()
                ->where("account_id", "=", $accountToReset->account_id)
                ->update([
                    "salt" => $newSalt,
                    "password" => $newPassword
                ]);

            MailUtils::sendMailPasswordChanged($accountToReset->email, $accountToReset->username);

            return redirect('/')->with('message', "Your password was changed, please login.");
        } else {
            return redirect('/')->with('message', "Invalid condition, please try again.");
        }

    }


}