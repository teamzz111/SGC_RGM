export class Encuesta {
  constructor(
    public nombre: string,
    public tipo: string,
    public fecha: string,
    public administrador: boolean,
    public coordinador: boolean,
    public liderdeproceso: boolean,
    public usuariodemo: boolean
  ) {}
}
