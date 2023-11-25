<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuroraSDG extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->file) {

            $content[] = "título\tSDG\tProbabilidade\tSDG2\tProbabilidade2";

            $fh = fopen($request->file, 'r+');
            $row = fgetcsv($fh, 108192, "\t");

            foreach ($row as $key => $value) {
                if ($value == "TITULO") {
                    define("TITULO", $key);
                }
                if ($value == "RESUMO") {
                    define("RESUMO", $key);
                }
            }

            while (($row = fgetcsv($fh, 108192, "\t")) !== false) {
                $titulo_resumo = $row[TITULO] . ' ' . $row[RESUMO];
                $json_titulo_resumo = str_replace('"', '', json_encode($titulo_resumo, JSON_UNESCAPED_UNICODE));

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://aurora-sdg.labs.vu.nl/classifier/classify/elsevier-sdg-multi');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, '{"text": "' . $json_titulo_resumo . '"}');
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

                $response = curl_exec($ch);

                curl_close($ch);

                $response = json_decode($response, true);
                usort($response["predictions"], function ($a, $b) {
                    return $b['prediction'] <=> $a['prediction'];
                });

                $content[] = $row[TITULO] . "\t" . $response["predictions"][0]["sdg"]["name"] . "\t" . $response["predictions"][0]["prediction"] . "\t" . $response["predictions"][1]["sdg"]["name"] . "\t" . $response["predictions"][1]["prediction"];

                ob_flush();
                flush();
            }

            $file = "sdgs.tsv";
            header('Content-type: text/plain');
            header("Content-Disposition: attachment; filename=$file");

            print_r(implode("\n", $content));
        }
    }
}