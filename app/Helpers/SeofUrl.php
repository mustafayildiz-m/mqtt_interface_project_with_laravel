<?php

function makeSeofUrl($name, $id)
{
    return SEOLink($name) . '-' . base64_encode($id);
}

function SEOLink($baslik)
{
    $metin_aranan = array("ş", "Ş", "ı", "ü", "Ü", "ö", "Ö", "ç", "Ç", "ş", "Ş", "ı", "ğ", "Ğ", "İ", "ö", "Ö", "Ç", "ç", "ü", "Ü");
    $metin_yerine_gelecek = array("s", "S", "i", "u", "U", "o", "O", "c", "C", "s", "S", "i", "g", "G", "I", "o", "O", "C", "c", "u", "U");
    $baslik = str_replace($metin_aranan, $metin_yerine_gelecek, $baslik);
    $baslik = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i", "-", $baslik);
    $baslik = strtolower($baslik);
    $baslik = preg_replace('/&.+?;/', '', $baslik);
    $baslik = preg_replace('|-+|', '-', $baslik);
    $baslik = preg_replace('/#/', '', $baslik);
    $baslik = str_replace('.', '', $baslik);
    $baslik = trim($baslik, '-');
    return $baslik;
}

function resolveSeofUrl($url)
{
    $url = explode('-', $url);
    return base64_decode(end($url));
}

function turkishDate($format, $datetime = 'now')
{
    $datetime = explode(' ', $datetime);
    $datetime = $datetime[0];
    $z = date("$format", strtotime($datetime));

    $gun_dizi = array(
        'Monday' => 'Pazartesi',
        'Tuesday' => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday' => 'Perşembe',
        'Friday' => 'Cuma',
        'Saturday' => 'Cumartesi',
        'Sunday' => 'Pazar',
        'January' => 'Ocak',
        'February' => 'Şubat',
        'March' => 'Mart',
        'April' => 'Nisan',
        'May' => 'Mayıs',
        'June' => 'Haziran',
        'July' => 'Temmuz',
        'August' => 'Ağustos',
        'September' => 'Eylül',
        'October' => 'Ekim',
        'November' => 'Kasım',
        'December' => 'Aralık',
        'Mon' => 'Pts',
        'Tue' => 'Sal',
        'Wed' => 'Çar',
        'Thu' => 'Per',
        'Fri' => 'Cum',
        'Sat' => 'Cts',
        'Sun' => 'Paz',
        'Jan' => 'Oca',
        'Feb' => 'Şub',
        'Mar' => 'Mar',
        'Apr' => 'Nis',
        'Jun' => 'Haz',
        'Jul' => 'Tem',
        'Aug' => 'Ağu',
        'Sep' => 'Eyl',
        'Oct' => 'Eki',
        'Nov' => 'Kas',
        'Dec' => 'Ara',
    );
    foreach ($gun_dizi as $en => $tr) {
        $z = str_replace($en, $tr, $z);
    }
    if (strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}


function printTree(array $tree, $selectedId = null, $depth = 0)
{
    $listSymbol = '•'; // Listeleme simgesi olarak kullanmak istediğiniz karakteri ayarlayın

    foreach ($tree as $node) {
        echo '<option value="' . $node['id'] . '"' . (($selectedId !== null && $selectedId == $node['id']) ? ' selected' : '') . '>' . str_repeat('&nbsp;', $depth * 4) . $listSymbol . ' ' . $node['name'] . '</option>';
        if (isset($node['children'])) {
            printTree($node['children'], $selectedId, $depth + 1);
        }
    }
}

function printUpperSubtree(array $tree, $nodeId)
{
    $listSymbol = <<<EOF
<svg  style="color: red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                                                </svg>
EOF;
    $listSymbol1 = '•';
    $upperSubtree = findUpperSubtree($tree, $nodeId);

    foreach (array_reverse($upperSubtree) as $node) {

        if ($node['id'] == $nodeId) {
            echo $listSymbol . PHP_EOL . '<u style="color: red">' . $node['name'] . '</u>';
        } else {
            echo $listSymbol1 . PHP_EOL . '<span>' . $node['name'];
        }
        echo '</span><br>';
    }
}

function printUpperSubtree4Mail(array $tree, $nodeId)
{
    $listSymbol = '<span style="width:20px;text-align:center;font-size:18px;">→</span>';

    $upperSubtree = findUpperSubtree($tree, $nodeId);

    if (count($upperSubtree) > 0) {
        foreach (array_reverse($upperSubtree) as $node) {

            if ($node['id'] == $nodeId) {
                echo PHP_EOL . '<u>' . $node['name'] . '</u>';
            } else {
                echo PHP_EOL . '<span>' . $node['name'] . $listSymbol;
            }
            echo '</span>';
        }
    } else {
        echo '<span>Cihaz herhangi bir bölgeye kayıt edilmemiş. </span>';

    }

}

function findUpperSubtree(array $tree, $nodeId, $path = [])
{
    foreach ($tree as $node) {
        if ($node['id'] == $nodeId) {
            $currentPath = array_merge($path, [$node]);
            if (isset($node['parent_id'])) {
                $currentPath = findUpperSubtree($tree, $node['parent_id'], $currentPath);
            }
            return $currentPath;
        }
    }
    return [];
}

function buildTree(array $items, $parentId = null)
{
    $tree = [];
    foreach ($items as $item) {
        if ($item['parent_id'] === $parentId) {
            $children = buildTree($items, $item['id']);
            if ($children) {
                $item['children'] = $children;
            }
            $tree[] = $item;
        }
    }
    return $tree;
}

function getSubtreeChildren($parentId)
{
    $children = \Illuminate\Support\Facades\DB::table('zones')->where('parent_id', $parentId)->get();

    $subtree = collect();

    foreach ($children as $child) {
        $subtree->push($child);
        $subtree = $subtree->merge(getSubtreeChildren($child->id));
    }

    return $subtree;
}

function getSubtreeIds($id)
{
    $subtree = getSubtreeById($id);

    if ($subtree) {
        return $subtree->pluck('id')->all();
    }

    return null; // Return null if the node is not found.
}

function getSubtreeById($id)
{
    $node = \App\Models\Zone::find($id);

    if ($node) {
        $subtree = collect([$node]); // Alt ağacı tutmak için bir koleksiyon oluşturuyoruz

        // Alt ağaçları almak için özyinelemeli bir işlev kullanıyoruz
        $subtree = $subtree->merge(getSubtreeChildren($id));

        return $subtree;
    }

    return null; // Kayıt bulunamadıysa null dönebiliriz.
}


