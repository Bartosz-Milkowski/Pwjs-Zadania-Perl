#!/usr/bin/perl
#Bartosz Miłkowski
#mb41449
#31B
#Zadanie na ocenę 5
$maks = $#ARGV + 1;
use Fcntl ':mode';
$j=0;
$operacje = 0;
$otw = 0;
#sprawdzenie ile i jakie argumenty
if($maks == 0)
{
	opendir ($folder, ".") or die "Nie można otworzyć folderu $!";
}
elsif ($maks > 3)
{
	#jeżeli za dużo argumentów to koniec
	die print "Podano za dużo parametrów\n";	
}
else
{
	while($j != $maks)
	{
		if($ARGV[$j] eq "-l")
		{		
			$operacje = $operacje + 1;
		}
		elsif($ARGV[$j] eq "-L")
		{
			$operacje = $operacje + 2;
		}
		#jeżeli w argumentach folder i nie otworzono innego wcześniej to otwórz katalog
		elsif(-d $ARGV[$j] && $otw != 1)
		{
			opendir ($folder, $ARGV[$j]) or die "Nie można otworzyć folderu $!";
			$fold = $ARGV[$j];
			$otw = 1;
		}
		else
		{
			#jeżeli zły argument to koniec
			die print "Podano nieprawidłowy parametr\n";
		}
		$j++;
	}
		#jeżeli w argumentach brak folderu to otwórz domowy
		if($otw == 0)
		{
			opendir ($folder, ".") or die "Nie można otworzyć folderu $!";
		}
}
#czytanie katalogu
@dane = readdir ($folder);

#gdy argument z folderem to dodaj ścieżkę do nazw plików
$i=0;
if($otw == 1)
{
	while($i != scalar @dane)
	{
		$dosort[$i] = "$fold";
		$dosort[$i].='/';
		$dosort[$i].= $dane[$i];
		$i++;
	}
#segregacja plików
@sciezka = sort @dosort;
}
@posort = sort @dane;


$i=0;
	#czytanie informacji o plikach
	while($i != scalar @posort)
	{       
		if($posort[$i] eq "." || $posort[$i] eq "..")
		{	
			$i++;
		}
		else
		{
			#wypisanie odpowiednich informacji, zależnych od parametrów
			#informacje o plikach
			if($otw == 1)
			{
        			@info= stat("$sciezka[$i]");
			}
			else
			{
        			@info= stat("$posort[$i]");
			}
			#informacje o właścicielu
			@nazwa= getpwuid("$info[4]");
			#informacje o czasie
			@czas=localtime("$info[9]");
	        	print "$posort[$i]";

			# gdy przełącznik -l
			if($operacje == 1 || $operacje == 3)
			{
				$rok = $czas[5] + 1900;
				if($czas[4]<9)
				{
					$mies = "0";
					$mies.=$czas[4] + 1;
				}
				else
				{
					$mies = $czas[4] + 1;
				}
				if($czas[3]<10)
				{
					$dzien = "0";
					$dzien.=$czas[3];
				}
				else
				{
					$dzien = $czas[3];
				}
				if($czas[2]<10)
				{
					$hh = "0";
					$hh.=$czas[2];
				}
				else
				{
					$hh = $czas[2];
				}
				if($czas[1]<10)
				{
					$mm = "0";
					$mm.=$czas[1];
				}
				else
				{
					$mm = $czas[1];
				}
				if($czas[0]<10)
				{
					$ss = "0";
					$ss.=$czas[0];
				}
				else
				{
					$ss = $czas[0];
				}
				print "  ","$info[7]","   ";
				print "$rok","-","$mies","-","$dzien"," ","$hh",":","$mm",":","$ss","  ";
				# utworzenie wyglądu praw
				$prawa = $info[2];
				$czy = S_ISDIR($prawa);
				$tab[0] = ($prawa & S_IRWXU) >> 6;
				$tab[1] = ($prawa & S_IRWXG) >> 3;
				$tab[2] = ($prawa & S_IRWXO);
				# sprawdzenie plik czy folder
				if($czy)
				{
					$pr='d';
				}
				else
				{
					$pr='-';
				}
				$k=0;	
				while($k < 3)
				{
					# sprawdzenie czy prawa czytania
					if($tab[$k] - 4 >= 0)
					{
						$pr.='r';
						$tab[$k] = $tab[$k] - 4;
					}
					else
					{
						$pr.='-';
					}
					# sprawdzenie czy prawa zapisania
					if($tab[$k] - 2 >= 0)
					{
						$tab[$k] = $tab[$k] - 2;
						$pr.='w';
					}
					else
					{
						$pr.='-';
					}
					# sprawdzenie czy prawa uruchamiania
					if($tab[$k] - 1 >= 0)
					{
						$pr.='x';
					}
					else
					{	
						$pr.='-';
					}
				$k++;
				}
				print $pr;
			}
			# gdy przełącznik -L
			if($operacje == 2 || $operacje == 3)
			{
				print "  $nazwa[0]";
			}
        		@info= ();
			@nazwa= ();
			@czas=();
			print "\n";
			$i++;
		}

    }
    closedir $folder;

