# Import 7 live collections + marble products into local MySQL
$ErrorActionPreference = 'Stop'
$Root = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
$Public = Join-Path $Root 'public'
$CollImgDir = Join-Path $Public 'uploads\collection'
$ProdImgDir = Join-Path $Public 'uploads\category'
$DataDir = Join-Path $Root 'storage\app\imports'
New-Item -ItemType Directory -Force -Path $CollImgDir, $ProdImgDir, $DataDir | Out-Null

$Mysql = 'C:\xampp\mysql\bin\mysql.exe'
$MysqlArgs = @('-uroot', 'stonehubindia')

function Escape-Sql([string]$s) {
    if ($null -eq $s) { return '' }
    return ($s -replace '\\', '\\\\' -replace "'", "''")
}

function Download-File([string]$Url, [string]$Dest) {
    if (Test-Path $Dest) { return $true }
    try {
        curl.exe -sL --fail --max-time 60 $Url -o $Dest
        return (Test-Path $Dest) -and ((Get-Item $Dest).Length -gt 500)
    } catch {
        return $false
    }
}

function Strip-Html([string]$html) {
    if (-not $html) { return '' }
    $t = [regex]::Replace($html, '(?is)<script[^>]*>.*?</script>', '')
    $t = [regex]::Replace($t, '(?is)<style[^>]*>.*?</style>', '')
    $t = [regex]::Replace($t, '<[^>]+>', ' ')
    $t = [System.Net.WebUtility]::HtmlDecode($t)
    $t = [regex]::Replace($t, '\s+', ' ').Trim()
    return $t
}

$collectionMeta = @{
    'Bellezza' = @{
        slug = 'bellezza'
        description = 'Stone Hub India is a best Bellezza Collection marble in Kishangarh, India. Best Imported Marble Collection in Kishangarh, Rajasthan. Explore exotic dark and gold-veined marbles curated for luxury interiors.'
        metatitle = 'Bellezza Collection | Imported Marble | Stone Hub India'
        metadescription = 'Stone Hub India is a best Bellezza Collection marble in Kishangarh, India. Best Imported Marble Collection in Kishangarh, Rajasthan.'
        imageFile = '214944853_01_09_2021_04_39_59.webp'
        localFallback = 'uploads/pages/collection-bellezza.webp'
    }
    'Migliore' = @{
        slug = 'migliore'
        description = 'Our Migliore marble is a collection of light-colored great opulence marbles. These are highly lustrous and shiny marbles that enhance the visual appearance of your home. Most are imported; manufactured pieces also meet high international standards. Popular for schools, offices, resorts, and shopping malls.'
        metatitle = 'Migliore Collection | Light Opulent Marble | Stone Hub India'
        metadescription = 'Top quality Migliore imported marble in Kishangarh, Rajasthan — light-colored lustrous slabs for luxury interiors.'
        imageFile = '815920618_01_09_2021_04_41_58.webp'
        localFallback = 'uploads/pages/collection-migliore.webp'
    }
    'Forte' = @{
        slug = 'forte'
        description = 'When it comes to the best marble collection for home décor, Forte qualifies as best in business. An extensive selection of exotic and luminous materials with bold color schemes keeps projects unique — modern artistic looks and classical sculptures alike.'
        metatitle = 'Forte Collection | Italian Marble | Stone Hub India'
        metadescription = 'Forte marble collection — exotic luminous materials and bold color schemes for modern and classical interiors.'
        imageFile = '56911678_01_09_2021_04_43_32.webp'
        localFallback = 'uploads/pages/collection-forte.webp'
    }
    'Amore' = @{
        slug = 'amore'
        description = 'Amore mostly consists of dark brown marbles with white quartz veins. Preferred for floors and walls, these marbles polish and cut easily and are durable. Popular for interior décor and outdoor furnishings like countertops and fountains.'
        metatitle = 'Amore Collection | Imported Marble | Stone Hub India'
        metadescription = 'Amore imported marble collection — dark brown marbles with white quartz veins for floors, walls, and countertops.'
        imageFile = '79415689_16_10_2023_04_48_30.webp'
        localFallback = 'uploads/pages/collection-amore.webp'
    }
    'Spazio' = @{
        slug = 'spazio'
        description = 'Spazio is the collection of alluring marbles, mostly from Spain. Primarily dark brown and rich in color, these contemporary countertop marbles are famous for accent walls and floor constructions in residential and commercial projects.'
        metatitle = 'Spazio Collection | Spanish Marble | Stone Hub India'
        metadescription = 'Spazio marble collection — alluring Spanish marbles for contemporary countertops, accent walls, and flooring.'
        imageFile = '362685643_01_09_2021_04_45_41.webp'
        localFallback = 'uploads/pages/collection-spazio.webp'
    }
    'Lontano' = @{
        slug = 'lontano'
        description = 'Lontano mostly consists of beautiful travertine stone collections. High-class stones imported from around the world — plain or engraved with vein designs ranging from gold beige tones to navy blue.'
        metatitle = 'Lontano Collection | Travertine | Stone Hub India'
        metadescription = 'Lontano travertine marble collection — natural high-class stones with gold beige to navy blue vein designs.'
        imageFile = '118137930_16_10_2023_04_46_53.webp'
        localFallback = $null
    }
    'Giovane' = @{
        slug = 'giovane'
        description = 'Giovane marble is mostly a collection of black figurines, best in quality and reasonable in price. High durability makes them popular for offices, shopping malls, and outdoors. Vein designs are mostly golden or white — a top choice of architects.'
        metatitle = 'Giovane Collection | Black Marble | Stone Hub India'
        metadescription = 'Giovane black marble collection — durable golden/white veined slabs for offices, malls, and outdoor projects.'
        imageFile = '432983135_01_09_2021_04_48_38.webp'
        localFallback = $null
    }
}

$order = @('Bellezza','Migliore','Forte','Amore','Spazio','Lontano','Giovane')
$catalog = [ordered]@{}
$allProducts = @{}

Write-Host '=== Scraping collections & products ==='
foreach ($name in $order) {
    $meta = $collectionMeta[$name]
    $url = "https://www.stonehubindia.com/collection/$name"
    $htmlPath = Join-Path $env:TEMP "shi-import-$name.html"
    curl.exe -sL $url -o $htmlPath
    $html = Get-Content $htmlPath -Raw -ErrorAction SilentlyContinue
    if (-not $html) { throw "Failed to fetch $url" }

    # Prefer local fashion hero if present; else download live collection image
    $imageRel = $null
    if ($meta.localFallback) {
        $localPath = Join-Path $Public ($meta.localFallback -replace '/', '\')
        if (Test-Path $localPath) {
            $imageRel = $meta.localFallback -replace '\\', '/'
        }
    }
    if (-not $imageRel) {
        $remote = "https://www.stonehubindia.com/public/uploads/collection/$($meta.imageFile)"
        $dest = Join-Path $CollImgDir $meta.imageFile
        if (Download-File $remote $dest) {
            $imageRel = "uploads/collection/$($meta.imageFile)"
        } else {
            $imageRel = "uploads/collection/$($meta.imageFile)"
        }
    }

    $products = @()
    $seen = @{}
    $matches = [regex]::Matches($html, 'href="https://www\.stonehubindia\.com/imported-marble/([^"#]+)"[\s\S]{0,1200}?src="(https://www\.stonehubindia\.com/public/uploads/product/[^"]+)"')
    foreach ($m in $matches) {
        $slug = $m.Groups[1].Value.Trim().ToLower()
        $img = $m.Groups[2].Value
        if ($seen.ContainsKey($slug)) { continue }
        $seen[$slug] = $true
        $products += [pscustomobject]@{ slug = $slug; image = $img }
        if (-not $allProducts.ContainsKey($slug)) {
            $allProducts[$slug] = [pscustomobject]@{
                slug = $slug
                image = $img
                collections = @($name)
            }
        } else {
            if ($allProducts[$slug].collections -notcontains $name) {
                $allProducts[$slug].collections += $name
            }
        }
    }

    $catalog[$name] = [pscustomobject]@{
        name = $name
        slug = $meta.slug
        description = $meta.description
        metatitle = $meta.metatitle
        metadescription = $meta.metadescription
        image = $imageRel
        products = $products
    }
    Write-Host ("  {0}: {1} products, image={2}" -f $name, $products.Count, $imageRel)
}

Write-Host ("=== Scraping {0} product detail pages ===" -f $allProducts.Count)
$i = 0
foreach ($slug in @($allProducts.Keys)) {
    $i++
    $prodUrl = "https://www.stonehubindia.com/imported-marble/$slug"
    $htmlPath = Join-Path $env:TEMP "shi-prod-$slug.html"
    curl.exe -sL --max-time 45 $prodUrl -o $htmlPath 2>$null
    $html = Get-Content $htmlPath -Raw -ErrorAction SilentlyContinue
    $name = ($slug -replace '-', ' ')
    $name = (Get-Culture).TextInfo.ToTitleCase($name)
    $description = ''
    $metatitle = $name
    $metadescription = ''
    $origin = ''
    $applications = 'Flooring, Wall cladding, Countertops'
    $finishes = 'Polished'
    $thickness = '15-20 mm'
    $color = ''
    $gallery = @()

    if ($html) {
        if ($html -match '<h1[^>]*>([^<]+)</h1>') { $name = Strip-Html $Matches[1] }
        if ($html -match 'name="description"\s+content="([^"]*)"') { $metadescription = [System.Net.WebUtility]::HtmlDecode($Matches[1]) }
        if ($html -match '<title>([^<]+)</title>') { $metatitle = Strip-Html $Matches[1] }
        if ($html -match '(?is)color\s*:?\s*</[^>]+>\s*([^<]+)') { $color = Strip-Html $Matches[1] }
        if ($html -match '(?is)Collection\s*:?\s*</[^>]+>\s*([A-Za-z]+)') { }

        # Origin bullets
        $bullets = @()
        if ($html -match '(?is)Origin and Appearance(.*?)(?:There are a wide|Applications|Specification|Similar|</section>|<h2)') {
            $section = $Matches[1]
            foreach ($li in [regex]::Matches($section, '(?is)<li[^>]*>(.*?)</li>')) {
                $text = Strip-Html $li.Groups[1].Value
                if ($text.Length -gt 20 -and $text -notmatch 'Home|Company|Collection') { $bullets += $text }
            }
            foreach ($p in [regex]::Matches($section, '(?is)<p[^>]*>(.*?)</p>')) {
                $text = Strip-Html $p.Groups[1].Value
                if ($text.Length -gt 40) { $bullets += $text }
            }
        }
        if ($bullets.Count -eq 0) {
            # fallback paragraphs in main content
            foreach ($p in [regex]::Matches($html, '(?is)<p[^>]*>(.*?)</p>')) {
                $text = Strip-Html $p.Groups[1].Value
                if ($text.Length -gt 80 -and $text -notmatch 'ISO:2015|Khasra No|leading manufacturer') {
                    $bullets += $text
                    if ($bullets.Count -ge 4) { break }
                }
            }
        }
        if ($bullets.Count -gt 0) {
            $lis = ($bullets | Select-Object -First 8 | ForEach-Object { "<li>$_</li>" }) -join ''
            $description = "<h3>Origin and Appearance</h3><ul>$lis</ul>"
            if ($color) { $description = "<p><strong>Color:</strong> $color</p>$description" }
            foreach ($b in $bullets) {
                if ($b -match '(?i)quarried from ([A-Za-z ]+)') { $origin = $Matches[1].Trim(); break }
                if ($b -match '(?i)from (Italy|Turkey|Spain|Brazil|Portugal|Greece|Egypt|China|India)') { $origin = $Matches[1]; break }
            }
            foreach ($b in $bullets) {
                if ($b -match '(?i)thickness[^\d]*(\d+\s*-?\s*\d*\s*mm)') { $thickness = $Matches[1].Trim(); break }
            }
        }

        foreach ($imgM in [regex]::Matches($html, 'src="(https://www\.stonehubindia\.com/public/uploads/product/[^"]+)"')) {
            $u = $imgM.Groups[1].Value
            if ($gallery -notcontains $u) { $gallery += $u }
        }
    }

    if (-not $description) {
        $description = "<p>$name is a premium imported marble slab available at Stone Hub India, Kishangarh. Ideal for flooring, wall cladding, and luxury interiors.</p>"
    }
    if (-not $metadescription) {
        $metadescription = "Buy $name from Stone Hub India - premium imported marble slabs in Kishangarh, Rajasthan."
    }

    # Local image: prefer existing pricelist file, else download
    $mainRemote = $allProducts[$slug].image
    if ($gallery.Count -gt 0) { $mainRemote = $gallery[0] }
    $ext = [IO.Path]::GetExtension(($mainRemote -split '\?')[0])
    if (-not $ext) { $ext = '.jpg' }
    $localName = "$slug$ext"
    $pricelistCandidates = @(
        (Join-Path $Public "uploads\pricelist\$slug.webp"),
        (Join-Path $Public "uploads\pricelist\$slug.jpg"),
        (Join-Path $Public "uploads\pricelist\$slug.jpeg"),
        (Join-Path $Public "uploads\pricelist\$slug.png")
    )
    $imageRel = $null
    foreach ($c in $pricelistCandidates) {
        if (Test-Path $c) {
            $imageRel = 'uploads/pricelist/' + [IO.Path]::GetFileName($c)
            break
        }
    }
    if (-not $imageRel) {
        $dest = Join-Path $ProdImgDir $localName
        if (Download-File $mainRemote $dest) {
            $imageRel = "uploads/category/$localName"
        } else {
            $imageRel = $mainRemote # store remote URL as fallback
        }
    }

    $galleryLocal = @()
    foreach ($g in ($gallery | Select-Object -First 4)) {
        if ($g -eq $mainRemote) { continue }
        $gExt = [IO.Path]::GetExtension(($g -split '\?')[0])
        if (-not $gExt) { $gExt = '.jpg' }
        $gName = "$slug-gallery-$($galleryLocal.Count)$gExt"
        $gDest = Join-Path $ProdImgDir $gName
        if (Download-File $g $gDest) {
            $galleryLocal += "uploads/category/$gName"
        }
    }

    $allProducts[$slug] = [pscustomobject]@{
        slug = $slug
        name = $name
        image = $imageRel
        gallery = ($galleryLocal -join ',')
        description = $description
        origin = $origin
        thickness = $thickness
        finishes = $finishes
        applications = if ($color) { "$applications | Color: $color" } else { $applications }
        metatitle = $metatitle
        metadescription = $metadescription
        metakeywords = "$name, imported marble, stone hub india, $($allProducts[$slug].collections -join ', ')"
        collections = $allProducts[$slug].collections
    }

    if ($i % 10 -eq 0 -or $i -eq $allProducts.Count) {
        Write-Host ("  scraped {0}/{1}" -f $i, $allProducts.Count)
    }
}

# Persist JSON snapshot
$snapshot = @{
    collections = @($order | ForEach-Object { $catalog[$_] })
    marbles = @($allProducts.Values)
}
$snapshot | ConvertTo-Json -Depth 8 | Set-Content (Join-Path $DataDir 'live-collections.json') -Encoding UTF8

Write-Host '=== Writing SQL ==='
$sqlPath = Join-Path $DataDir 'live-collections-import.sql'
$sb = New-Object System.Text.StringBuilder
[void]$sb.AppendLine('SET FOREIGN_KEY_CHECKS=0;')
[void]$sb.AppendLine('DELETE FROM collection_marble;')
[void]$sb.AppendLine('DELETE FROM collections;')
[void]$sb.AppendLine('DELETE FROM marbles;')
[void]$sb.AppendLine('ALTER TABLE collections AUTO_INCREMENT=1;')
[void]$sb.AppendLine('ALTER TABLE marbles AUTO_INCREMENT=1;')
[void]$sb.AppendLine('ALTER TABLE collection_marble AUTO_INCREMENT=1;')

$id = 1
$collIdMap = @{}
foreach ($name in $order) {
    $c = $catalog[$name]
    $collIdMap[$name] = $id
    $now = (Get-Date).ToString('yyyy-MM-dd HH:mm:ss')
    $kw = Escape-Sql ("{0} marble collection, imported marble, stone hub india" -f $c.name)
    $line = 'INSERT INTO collections (id, name, slug, image, description, status, metatitle, metadescription, metakeywords, schema_markup, created_at, updated_at) VALUES (' +
        $id + ', ''' + (Escape-Sql $c.name) + ''', ''' + (Escape-Sql $c.slug) + ''', ''' + (Escape-Sql $c.image) + ''', ''' +
        (Escape-Sql $c.description) + ''', 1, ''' + (Escape-Sql $c.metatitle) + ''', ''' + (Escape-Sql $c.metadescription) +
        ''', ''' + $kw + ''', NULL, ''' + $now + ''', ''' + $now + ''');'
    [void]$sb.AppendLine($line)
    $id++
}

$marbleId = 1
$marbleIdMap = @{}
foreach ($slug in ($allProducts.Keys | Sort-Object)) {
    $m = $allProducts[$slug]
    $marbleIdMap[$slug] = $marbleId
    $now = (Get-Date).ToString('yyyy-MM-dd HH:mm:ss')
    if ($m.gallery) {
        $arr = @($m.gallery -split ',' | Where-Object { $_ })
        $galleryJson = Escape-Sql (($arr | ConvertTo-Json -Compress))
    } else {
        $galleryJson = '[]'
    }
    $line = 'INSERT INTO marbles (id, name, slug, image, gallery, description, origin, thickness, finishes, applications, status, metatitle, metadescription, metakeywords, schema_markup, created_at, updated_at) VALUES (' +
        $marbleId + ', ''' + (Escape-Sql $m.name) + ''', ''' + (Escape-Sql $m.slug) + ''', ''' + (Escape-Sql $m.image) +
        ''', ''' + $galleryJson + ''', ''' + (Escape-Sql $m.description) + ''', ''' + (Escape-Sql $m.origin) + ''', ''' +
        (Escape-Sql $m.thickness) + ''', ''' + (Escape-Sql $m.finishes) + ''', ''' + (Escape-Sql $m.applications) +
        ''', 1, ''' + (Escape-Sql $m.metatitle) + ''', ''' + (Escape-Sql $m.metadescription) + ''', ''' +
        (Escape-Sql $m.metakeywords) + ''', NULL, ''' + $now + ''', ''' + $now + ''');'
    [void]$sb.AppendLine($line)
    $marbleId++
}

$now = (Get-Date).ToString('yyyy-MM-dd HH:mm:ss')
foreach ($slug in ($allProducts.Keys | Sort-Object)) {
    $m = $allProducts[$slug]
    $mid = $marbleIdMap[$slug]
    foreach ($cname in $m.collections) {
        $cid = $collIdMap[$cname]
        if (-not $cid) { continue }
        [void]$sb.AppendLine("INSERT INTO collection_marble (collection_id, marble_id, created_at, updated_at) VALUES ($cid, $mid, '$now', '$now');")
    }
}

[void]$sb.AppendLine('SET FOREIGN_KEY_CHECKS=1;')
$sql = $sb.ToString()
[IO.File]::WriteAllText($sqlPath, $sql, [Text.UTF8Encoding]::new($false))
Write-Host "SQL written: $sqlPath ($([math]::Round((Get-Item $sqlPath).Length/1KB)) KB)"

Write-Host '=== Importing into MySQL ==='
cmd /c "`"$Mysql`" -uroot stonehubindia < `"$sqlPath`""
if ($LASTEXITCODE -ne 0) {
    Get-Content $sqlPath -Raw -Encoding UTF8 | & $Mysql -uroot --default-character-set=utf8mb4 stonehubindia
}

Write-Host '=== Verify ==='
& $Mysql @MysqlArgs -e "SELECT id,name,slug,LEFT(image,50) img FROM collections ORDER BY id; SELECT COUNT(*) AS marbles FROM marbles; SELECT c.name, COUNT(cm.marble_id) cnt FROM collections c LEFT JOIN collection_marble cm ON cm.collection_id=c.id GROUP BY c.id,c.name ORDER BY c.id;"
Write-Host 'DONE'
