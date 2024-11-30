import {User} from "@/models/User";

export class Event {
    id: number;
    titulo: string;
    descricao: string;
    categoria: string;
    link: string;
    foto: string;
    tipo_evento: string;
    usuario: User;
    data_evento: string;

    constructor(data: Partial<Event>) {
        this.id = data.id ?? 0;
        this.titulo = data.titulo ?? '';
        this.descricao = data.descricao ?? '';
        this.categoria = data.categoria ?? '';
        this.link = data.link ?? '';
        this.foto = data.foto ?? '';
        this.tipo_evento = data.tipo_evento ?? '';
        this.usuario = new User(data.usuario ?? {});
        this.data_evento = this.formatDate(data.data_evento ?? '');
    }

    formatDate(date: string): string {
        const eventDate = new Date(date);

        const optionsTime: Intl.DateTimeFormatOptions = {
            hour: '2-digit',
            minute: '2-digit',
        };

        const optionsDate: Intl.DateTimeFormatOptions = {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        };

        const time = eventDate.toLocaleString('pt-BR', optionsTime);
        const formattedDate = eventDate.toLocaleString('pt-BR', optionsDate);

        // Concatenate time and date in the desired order
        return `${time} - ${formattedDate}`;
    }

    // Example method
    getSummary(): string {
        return `${this.titulo} (${this.tipo_evento}) - ${this.categoria}: ${this.descricao}`;
    }
}
