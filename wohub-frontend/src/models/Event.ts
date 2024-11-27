export class Event {
    id: number;
    titulo: string;
    descricao: string;
    categoria: string;
    link: string;
    foto: string;
    tipo_evento: string;

    constructor(data: Partial<Event>) {
        this.id = data.id ?? 0;
        this.titulo = data.titulo ?? '';
        this.descricao = data.descricao ?? '';
        this.categoria = data.categoria ?? '';
        this.link = data.link ?? '';
        this.foto = data.foto ?? '';
        this.tipo_evento = data.tipo_evento ?? '';
    }

    // Example method
    getSummary(): string {
        return `${this.titulo} (${this.tipo_evento}) - ${this.categoria}: ${this.descricao}`;
    }
}
