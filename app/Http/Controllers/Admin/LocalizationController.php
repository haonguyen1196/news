<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class LocalizationController extends Controller
{
    public function adminIndex(): View
    {
        $langs = Language::all();
        return view('admin.localization.admin-index', compact('langs'));
    }

    public function frontendIndex(): View
    {
        $langs = Language::all();
        return view('admin.localization.frontend-index', compact('langs'));
    }

    //tạo ra file string lấy từ nội dung __()
    public function extractLocalizationString(Request $request)
    {
        //data từ form
        $directories = explode(',',$request->directory);
        $languageCode = $request->language_code;
        $fileName = $request->file_name;
        $localizationStrings = [];

        foreach($directories as $directory){
            //lấy các files trong thư mục $directory (cách file blade)
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

            foreach($files as $file){
                //không lấy các thư mục chỉ lấy các file
                if($file->isDir()){
                    continue;
                }

                //lấy nội dung các file
                $contents = file_get_contents($file->getPathname());

                //lấy các nội dung tĩnh cần chuyển ngôn ngữ trong __()
                preg_match_all('/__\([\'"](.+?)[\'"]\)/', $contents, $matches);

                //đưa string vào mảng
                if(!empty($matches[1])){
                    foreach($matches[1] as $match){
                        $match = preg_replace('/^(frontend|admin)\./', '', $match);
                        $localizationStrings[$match] = $match;
                    }
                }

            }
        }

        //tạo nội dung cho file từ mảng string
        $phpArray = "<?php\n\nreturn " . var_export($localizationStrings, true) . ";\n";

        //tạo folder ngôn ngữ nếu chưa tồn tại
        if(!File::isDirectory(lang_path($languageCode))){
            File::makeDirectory(lang_path($languageCode), 0755, true);
        }

        //đưa nội dung vào file
        file_put_contents(lang_path($languageCode.'/'.$fileName.'.php'), $phpArray);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->back();
    }

    //update string lang
    public function updateLangString(Request $request)
    {
        // tên tệp, chuỗi dịch, ngôn ngữ muốn xử dụng để lấy bản dịch
        $languageStrings = trans($request->file_name, [], $request->lang_code);

        $languageStrings[$request->key] = $request->value;

        //tạo nội dung cho file từ mảng string
        $phpArray = "<?php\n\nreturn " . var_export($languageStrings, true) . ";\n";

        //đưa nội dung vào file
        file_put_contents(lang_path($request->lang_code.'/'.$request->file_name.'.php'), $phpArray);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->back();
    }

    //translate string
    public function translateString(Request $request)
    {
        try{
            $langCode = $request->language_code;
            //ví dụ tham số('forntend', [], 'en)
            $languageStrings = trans($request->file_name, [], $request->language_code);

            //biến mảng thành 1 tập hợp mảng có value là key trước đó
            $keyStrings = array_keys($languageStrings);

            // //biến mảng thành 1 chuỗi có các item của mảng nối với nhau
            // $text = implode(' | ', $keyStrings);
            // //tách thành từng phần 1000
            // $partsText = str_split($text, 1000);

            // Tạo mảng chứa các phần tách
            $partsText = array();
            $currentChunk = '';
            $delimiterLength = strlen(' | '); // Độ dài ký tự phân cách
            foreach ($keyStrings as $part) {
                $part = trim($part);
                if (strlen($currentChunk) + strlen($part) + $delimiterLength <= 900) {
                    if (!empty($currentChunk)) {
                        $currentChunk .= ' | ';
                    }
                    $currentChunk .= $part;
                } else {
                    $partsText[] = $currentChunk;
                    $currentChunk = $part;
                }
            }
            if (!empty($currentChunk)) {
                $partsText[] = $currentChunk;
            };

            $translatedText = '';

            foreach($partsText as $key => $partText) {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'x-rapidapi-host' => getSetting('site_microsoft_api_host'),
                    'x-rapidapi-key' => getSetting('site_microsoft_api_key'),
                ])->post("https://microsoft-translator-text-api3.p.rapidapi.com/translate?to=$langCode&from=en&textType=plain", [
                    [
                        "Text" => $key == 1? ' | '.$partText : $partText,
                    ]
                ]);
                // gom các chuỗi tách ra lại thành 1
                $translatedText .= json_decode($response->body())[0]->translations[0]->text;
            }
            // biến chuỗi thàng mảng
            $translatedValues = explode(' | ', $translatedText);
            //gộp 2 mảng thàng 1, tham số(key, value)
            $updateArray = array_combine($keyStrings, $translatedValues);

            //tạo nội dung cho file từ mảng string
            $phpArray = "<?php\n\nreturn " . var_export($updateArray, true) . ";\n";

            //đưa nội dung vào file
            file_put_contents(lang_path($langCode.'/'.$request->file_name.'.php'), $phpArray);

            return response()->json(['status' => 'success', 'message' => __('admin.Translation is completed')]);
        } catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);

        }
    }
}
