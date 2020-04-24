#!/usr/bin/perl
#Bartosz Miłkowski
#mb41449
#31B
#Zadanie na ocenę 5	

#gdy podano argument z nazwami użytkowników
if ($#ARGV > -1) 
{	
	open(FD, '<', @ARGV[0]) or die "Błąd otwarcia pliku z nazwami kont: $ARGV[0]\n";
	chomp(@wybrani = <FD>);		# wczytanie nazw kont do tablicy
	close FD;
}
print "Podaj nazwę pliku do parsowania: ";

$nazwa = <STDIN>;	# nazwa pliku html
			
open($plik, "$nazwa") or die "Błąd otwarcia pliku do parsowania:\n";

#uzyskanie lini z wynikami
while( $r = <$plik>)
{
	if ($r =~ m/(<tbody>).*(<\/tr>)/) 
	{
		$linia = $r; #linia z wynikami
	}
}					
close $plik;

# rozbicie linii z wynikami na wiersz do tablicy
@linie = split("</tr>", $linia);

foreach $l (@linie) { $l .= "</tr>"; }			# zachowanie struktury <tr>...</tr>

	foreach $lin (@linie) 
	{
		if ($lin =~ m/headerrow\">(.*)<\/tr>/) 		# wyciągnięcie linii z nazwami kolumn
		{ 
			$kolumna = $1;
		}
	}	

@tab_kolumn = split("</th>", $kolumna);				# uzyskanie nazw kolumn html

foreach $l (@tab_kolumn) { $l .= "</th>"; }			# zachowanie struktury <th>...</th>

foreach $kol (@tab_kolumn) 
{							
	if ($kol =~ m/.*">(.*)<\/a.*/ || $kol =~ m/<th>(.*)<\/th>/) 	# uzykanie dokładnych nazw kolumn
	{
		$kol = $1;
	}
}				
$in = 1;
$i = 0;
# zapis indeksów potrzebnych kolumn, aby móc wypisać poszczególne punkty i ich sumę
foreach $lin (@tab_kolumn) 
{							
	if (($lin eq "NAME" || $lin eq "SCORE") || $lin =~ m/WIPING.*/) 
	{			
		$inter[$i] = $in;
		$i++;			
	}
	$in++;
}
#zapis wyników do pliku oraz ich wyświetlenie
foreach $ele (@linie) 
{						
		@rzad = ();				# elementy wiersza
		$nazwa = "";				# nazwa użytkownika
													
		if ($ele =~ m/problemrow\">(.*)<\/tr>/) 
		{	
			@rzad = split("<\/td>",$1);
			foreach $l (@rzad) 
			{ 
				$l .= "<\/td>";
				if ($l =~ m/.*users\/(.*)/) 
				{
					$nazwa = $l;
					if ($nazwa =~ m/s\/(.*)">/) { $nazwa = $1; }
				}
				if ($l =~ m/.*">(.*)<\/.*/) { $l = $1; };
				if ($l =~ m/(.*)<\//) { $l = $1; }; 	
				$l =~ s/\./\,/;  # zamiana . na ,
				$l =~ s/\-/0,0/; # zamiana - na 0,0		 
			}
		}
		if ($#ARGV > -1) 
		{	# wyświetlanie wybranych użytkowników			
			foreach $osoba (@wybrani) 
			{
				if ($osoba eq $nazwa && ($nazwa ne "null" && $nazwa ne "")) 
				{
					print "\"$nazwa\"";
					foreach $in (@inter) 
					{
						print "\,\"$rzad[$in-1]\"";
					}
					print "\n";
				}
			}		
		}
		else
		{
			# wyświetlanie wszystkich użytkowników
			if ($nazwa ne "null" && $nazwa ne "") 
			{	
				print "\"$nazwa\"";
				foreach $in (@inter) 
				{
					print "\,\"$rzad[$in-1]\"";
				}
				print "\n";
			}
		}
}

