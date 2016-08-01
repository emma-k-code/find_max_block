# find_max_block
ver 2.1_20160801
1.使用foreach將$check陣列全部搜尋一遍 並把已搜尋過的都改為0<br>
2.當搜尋到1時 將其座標存入$haveOne 相鄰的座標存入$needFind中<br>
3.再使用foreach 搜尋$needFind中座標的相鄰座標 並將以搜尋的座標從$needFind中刪除<br>
4.重複2跟3直到$needFind中已沒有座標<br>
5.將$haveOne中所存的座標數量與$big比對 當$haveOne>$big時 $big = $haveOne<br>
6.依$big中的座標 將$output中相應的座標改為1<br>
7.用foreach輸出$output的內容<br>