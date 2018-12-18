SELECT
  tiposhabitaciones.NomTipo,
  precioshabitaciones.CodServicioHab,
  precioshabitaciones.ValorServicio
FROM precioshabitaciones
  INNER JOIN tiposhabitaciones
    ON precioshabitaciones.CodTipoHab = tiposhabitaciones.CodTipoHab