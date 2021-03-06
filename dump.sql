PGDMP     7    !            
    x            galih %   10.14 (Ubuntu 10.14-0ubuntu0.18.04.1) %   10.14 (Ubuntu 10.14-0ubuntu0.18.04.1)     m           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            n           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            o           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            p           1262    16384    galih    DATABASE     w   CREATE DATABASE galih WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';
    DROP DATABASE galih;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            q           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    13041    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            r           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    16395    emails    TABLE     �   CREATE TABLE public.emails (
    id integer NOT NULL,
    to_email character(255),
    title character(255),
    message character(500),
    id_user integer NOT NULL,
    status character(255)
);
    DROP TABLE public.emails;
       public         postgres    false    3            �            1259    16412    emails_id_seq    SEQUENCE     �   ALTER TABLE public.emails ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.emails_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    3    198            �            1259    16385    user    TABLE     �   CREATE TABLE public."user" (
    id integer NOT NULL,
    username character(255) NOT NULL,
    password character(255) NOT NULL
);
    DROP TABLE public."user";
       public         postgres    false    3            �            1259    16393    user_id_seq    SEQUENCE     �   ALTER TABLE public."user" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    3    196            i          0    16395    emails 
   TABLE DATA               O   COPY public.emails (id, to_email, title, message, id_user, status) FROM stdin;
    public       postgres    false    198   �       g          0    16385    user 
   TABLE DATA               8   COPY public."user" (id, username, password) FROM stdin;
    public       postgres    false    196   �       s           0    0    emails_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.emails_id_seq', 21, true);
            public       postgres    false    199            t           0    0    user_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.user_id_seq', 1, true);
            public       postgres    false    197            �
           2606    16402 	   emails Id 
   CONSTRAINT     I   ALTER TABLE ONLY public.emails
    ADD CONSTRAINT "Id" PRIMARY KEY (id);
 5   ALTER TABLE ONLY public.emails DROP CONSTRAINT "Id";
       public         postgres    false    198            �
           2606    16392    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public         postgres    false    196            i   7  x��K
�@��Sx�'���΍���%"$z���ū:A7��:^]sw�Mda��%��:l-U��ܗ�� ����0�_}�n楧�Q�k�g_}��#�o�/�O��[���������z��pp���縏��/F���}��}1��%��>��p�q_�p-���<�KQ��??r�A`<�}�!?�#�����������"�ܛ'����jP>��Q>�'�3禕�Q>5(�9����A�̹g�|�O�g�57�|jP>sn�)�S��s�O�(����1P>ʧ��?���A��05�/UM�I      g   (   x�3�LO���P��3;?';3+���x��2 �+F��� �	Dc     