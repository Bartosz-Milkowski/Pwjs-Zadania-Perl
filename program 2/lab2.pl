#!/usr/bin/perl
#Bartosz Miłkowski
#mb41449
#31B
#Zadanie na ocenę 5
print ("Podaj nazwę pliku do parsowania\n");
$pliczek = <>;
open ($plik, $pliczek) or die "Nie można otworzyć pliku";
$ilosc = 0;
$wyk = 0;
$cw = 0;
$lab = 0;
$sem = 0;
$sta1 = 0;
$sta2 = 0;
$niesta = 0;
$i = 0;
$nazwy[0] = {"początek"};
$zm1 = 0;
while( $r = <$plik>)
{	
	#wyciągnięcie daty i czasu zajęć
	if($r =~ m/^DTSTART/)
	{
		@tmp = split(/:/, $r);
		$data[$zm1][0] = substr($tmp[1], 6, 2);
		$data[$zm1][1] = substr($tmp[1], 4, 2);
		$data[$zm1][2] = substr($tmp[1], 0, 4);
		$czas[$zm1][0] = substr($tmp[1], 9, 2);
		$czas[$zm1][1] = substr($tmp[1], 11, 2);
	}
	if($r =~ m/^DTEND/)
	{
		@tmp= ();
		@tmp = split(/:/, $r);
		$czas[$zm1][2] = substr($tmp[1], 9, 2);
		$czas[$zm1][3] = substr($tmp[1], 11, 2);
		# zamiana ilości zajęć na godziny lekcyjne
		if(int($czas[$zm1][2])-int($czas[$zm1][0]) >= 5)
		{
			$godz = 5;
		}
		elsif(int($czas[$zm1][2])-int($czas[$zm1][0]) == 4)
		{
			$godz = 4;
		}
		elsif(int($czas[$zm1][2])-int($czas[$zm1][0]) == 3)
		{
			$godz = 3;
		}
		elsif(int($czas[$zm1][2])-int($czas[$zm1][0]) == 2)
		{
			$godz = 2;
		}
		elsif(int($czas[$zm1][2])-int($czas[$zm1][0]) == 1)
		{	
			if(abs(int($czas[$zm1][3])-int($czas[$zm1][1])) >= 30)
			{
				$godz = 2;
			}
			else
			{
				$godz = 1;
			}
		}
		else
		{
			$godz = 1;
		}
		$zm1++;
	}

	#wyciągnięcie formy zajęć, statusu sali, ilości godzin, grup, podziału na rodzaj studiów
	if($r =~ m/^SUMMARY/)
	{	
		$godziny = $godziny + $godz;
		@spl = split(/ - /, $r);
		if(scalar @spl == 2)
		{
			@tmp1 = split(/,/, $spl[1]);
		}
		elsif(scalar @spl == 3)
		{
			@tmp1 = split(/,/, $spl[2]);
		}
		$sala[$ilosc] = substr($tmp1[3],7,11);
		$grupa[$ilosc] = substr($tmp1[2],8);
		print $sala;
		$spl[0] =~ s/SUMMARY://;
		$przedmioty[$ilosc] = $spl[0];
		$j = 0 ;
		$zm = 0 ;
		while($j != (scalar @nazwy))
		{
		if($spl[0] eq $nazwy[$j])
		{
			$zm = 1;
			$nazwy_il[$j] = $nazwy_il[$j] + $godz;
		}
		$j++;
		}
		if($zm == 0)
		{
			$nazwy[$i] = $spl[0];
			$nazwy_il[$i] = $nazwy_il[$j] + $godz;
			$i++;
		}
		$ilosc++;
	}
	if($r =~ m/^(SUMMARY).+(_W)/)
	{
		$wyk = $wyk + $godz;
		$forma[$ilosc-1] = "W";
		$status[$ilosc-1] = "wykład";	
	}
	elsif($r =~ m/^(SUMMARY).+(_A_)/)
	{
		$cw = $cw + $godz;
		$forma[$ilosc-1] = "A";
		$status[$ilosc-1] = "audytoryjne";	
	}
	elsif($r =~ m/^(SUMMARY).+(_L_)/)
	{
		$lab = $lab + $godz;
		$forma[$ilosc-1] = "L";
		$status[$ilosc-1] = "laboratorium";	
	}
	elsif($r =~ m/^(SUMMARY).+(_S_)/)
	{
		$sem = $sem + $godz;
		$forma[$ilosc-1] = "S";
		$status[$ilosc-1] = "seminarium";	
	}
	if(($r =~ m/^(SUMMARY).+(S1_)/) || ($r =~ m/^(SUMMARY).+(6_spec)/))
	{
		$sta1 = $sta1 + $godz;	
	}
	if($r =~ m/^(SUMMARY).+(semestr 2)/ && $r !~ m/(N1_)/)
	{
		$sta1 = $sta1 + $godz;	
	}
	elsif(($r =~ m/^(SUMMARY).+(S2_)/) || ($r =~ m/^(SUMMARY).+(semestr 1)/))
	{
		$sta2 = $sta2 + $godz;	
	}
	elsif($r =~ m/^(SUMMARY).+(N1_)/)
	{
		$niesta = $niesta + $godz;	
	}
}
close $plik;
#wypisanie form zajęć
print "Ilość godzin lekcyjnych w semestrze to : ", "$godziny\n";
print "Ilość godzin lekcyjnych wykładów w semestrze to : ", "$wyk\n";
print "Ilość godzin lekcyjnych ćwiczeń w semestrze to : ", "$cw\n";
print "Ilość godzin lekcyjnych laboratoriów w semestrze to : ", "$lab\n";
print "Ilość godzin lekcyjnych seminariów w semestrze to : ", "$sem\n";
print "Ilość godzin lekcyjnych w semestrze studiów stacjonarnych stopnia nr 1 to : ", "$sta1\n";
print "Ilość godzin lekcyjnych w semestrze studiów stacjonarnych stopnia nr 2 to : ", "$sta2\n";
print "Ilość godzin lekcyjnych w semestrze studiów niestacjonarnychto : ", "$niesta\n";
print "Nazwy przedmiotów i ich liczba godzin lekcyjnych:\n";
$j = 0;
while($j != scalar @nazwy)
{

	print ($nazwy[$j]," - ",$nazwy_il[$j],"\n");
	$j++;
}
#zapis danych do pliku csv
$str = "\"Data zajęć\",\"Od\",\"Do\",\"Sala\",\"Przedmiot\",\"Froma zajęć\",\"Grupa\",\"Status sali\",";
open (fh, ">", "Tabela.csv");
print fh $str,"\n";
$j = 0;
while($j != scalar @sala)
{

	$str = "\"$data[$j][0].$data[$j][1].$data[$j][2]\",\"$czas[$j][0]:$czas[$j][1]\",\"$czas[$j][2]:$czas[$j][3]\",\"$sala[$j]\",\"$przedmioty[$j]\",\"$forma[$j]\",\"$grupa[$j]\",\"$status[$j]\",\n";
	print fh $str;
	$j++;
}

close(fh);


