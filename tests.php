INSERT INTO dmht (vn,hn,vstdate,vsttime,ptname,age_y, age_m, age_d,addrpart,aid, tell,bps1)  
SELECT o.vn, o.hn, o.vstdate, o.vsttime, CONCAT(p.pname,p.fname,' ',p.lname) AS ptname, v.age_y, v.age_m, v.age_d, CONCAT(p.addrpart,' ','ม.',' ',p.moopart,' ',t.full_name) AS addrpart ,aid,p.hometel, o.bps FROM opdscreen o
LEFT JOIN patient p on  p.hn = o.hn
LEFT OUTER JOIN vn_stat v ON o.vn=v.vn
LEFT OUTER JOIN thaiaddress t ON v.aid=t.addressid
WHERE o.bps > 159 and o.vstdate = "2018-08-27" ORDER BY vn DESC