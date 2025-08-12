// Ponieważ całe renderowanie odbywa się teraz w PHP (w pliku functions.php),
// funkcja save() nie musi niczego zapisywać do bazy danych.
// Zwrócenie `null` informuje WordPressa, aby polegał na renderowaniu po stronie serwera.
export default function save() {
	return null;
}
