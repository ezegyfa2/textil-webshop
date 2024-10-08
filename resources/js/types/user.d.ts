export default interface User {
    id?: number;
    name: string;
    email: string;
    email_verified_at?: Date;
    password?: string;
    created_at?: Date;
}