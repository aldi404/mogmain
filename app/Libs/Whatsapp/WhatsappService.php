<?php

namespace App\Libs\Whatsapp;

use App\Jobs\WhatsappJob;
use App\Models\NewModel\Invoice;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class WhatsappService
{
    function sendFile() {
        $token = Cache::get("whatsapp:token");
        $noWas = Cache::get("whatsapp:no",[]);
        $tos = $this->getNoStudents();
        $tot = count($tos)/count($noWas);
        $chunk_tos = array_chunk($tos,ceil($tot));
        foreach ($chunk_tos as $key => $chunk) {
            foreach ($chunk as $to) {
                $no_wa = $to["no"];
                $document = $to["inv_id"];
                $name = $to["name"];
                $no_inv = $to["no_inv"];
                $tgl = $to["tgl"];
                $due_date = $to["due_date"];
                $nominal = $to["nominal"];
                dd($this->getTemplate($name,$no_inv,$tgl,$due_date,$nominal));
                $tm = $this->getTime($noWas[$key]);
                WhatsappJob::dispatch($noWas[$key],$no_wa,$this->getMsg($this->getTemplate($name,$no_inv,$tgl,$due_date,$nominal)),$token,$document)
                ->delay($tm);
            }
        }
    }
    private function getNoStudents() {
        $students = Student::select("id","full_name","parent_phone")
            ->whereNotNull("parent_phone")
            ->whereNot("parent_phone","")
            ->where('status', 1)
            ->with("invoiceUnpaid")
            ->get();
        $noUsers = [];
        $phones = [];
		foreach ($students as $user) {
			$noHp = str_split(str_replace("-", "", str_replace("+", "", $user->parent_phone)));
            $noUser = "";
			if (count($noHp) > 10 && count($noHp) < 15) {
				if ($noHp[0] == "6" && $noHp[1] == "2") {
					$noUser = implode($noHp);
				} elseif ($noHp[0] == "8") {
					$noUser = "62" . implode($noHp);
				} elseif ($noHp[0] == "0" && $noHp[1] == "8") {
					unset($noHp[0]);
					$noUser =  "62" . implode($noHp);
				}
			}elseif(count($noHp) == 8 || count($noHp) == 9 || count($noHp) == 10){
				$noUser =  "628" . implode($noHp);
			}
            if($noUser && !in_array($noUser, $phones) && $user->invoiceUnpaid){
                $phones[] = $noUser;
                $noUsers[] = [
                    "id" => $user->id,
                    "inv_id" => "https://biffiacademy.com/admin/invoice/{$user->invoiceUnpaid->id}/print",
                    "no_inv" => $user->invoiceUnpaid->invoice_number,
                    "tgl" => $user->invoiceUnpaid->invoice_date->format('d-m-Y'),
                    "due_date" => $user->invoiceUnpaid->due_date->format('d-m-Y'),
                    "nominal" => number_format($user->invoiceUnpaid->amount, 0, ',', '.'),
                    "no" => $noUser,
                    "name" => $user->full_name,
                ];
            }
		}
        return $noUsers;       
    }
    private function getTime($no_wa) {
        $no_wa = $this->getNo($no_wa);
		$nw = now();
        $tm = Cache::get("whatsapp:time:{$no_wa}",$nw);
		if($tm->toDateTimeString() < $nw->toDateTimeString()){
			$tm = $nw;
		}
        $tm = $tm->addSeconds(6);
        Cache::put("whatsapp:time:{$no_wa}",$tm);
        return $tm;
    }
    private function getNo($data) {
        $x = explode(":",$data);
        return $x[0];
    }
    private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	private function getMsg($msg) {
        $text = $this->generateRandomString(7);
		$text = strtoupper($text);
        return "*$text*\n".$msg;
    }
    function genInv($month)
    {
        $students = Student::where('status', 1)->get();

        foreach ($students as $student) {
            $exists = Invoice::where('student_id', $student->id)
                           ->where('month_year', $month)
                           ->exists();
            if (!$exists) {
                $amount = $student->jenis_paket == 1 ? 250000 : 350000;
                Invoice::create([
                    'invoice_number' => Invoice::generateInvoiceNumber(),
                    'student_id' => $student->id,
                    'invoice_date' => Carbon::now(),
                    'due_date' => Carbon::now()->addDays(7),
                    'package_type' => $student->jenis_paket,
                    'amount' => $amount,
                    'month_year' => $month,
                    'status' => Invoice::UNPAID
                ]);
            }
        }
    }
    function getTemplate($name,$no_inv,$tgl,$due_date,$nominal) {
       $template = "Yth. {$name},\n\n
                Terima kasih atas kepercayaan Anda dalam menggunakan layanan kami.\n
                Bersama email ini, kami lampirkan invoice dengan rincian sebagai berikut:\n\n
                Nomor Invoice: [{$no_inv}]\n
                Tanggal Terbit: [{$tgl}]\n
                Jatuh Tempo: [{$due_date}]\n
                Jumlah Tagihan: [Rp {$nominal},-]\n
                Silakan lakukan pembayaran sebelum tanggal jatuh tempo untuk menghindari gangguan layanan.\n\n
                Jika Anda memiliki pertanyaan mengenai invoice ini, jangan ragu untuk menghubungi kami di nomor ini.\n\n
                Hormat kami,\n
                *Bila*\n
                *Biffi Academy*\n
                ";
        return $template;
    }
}